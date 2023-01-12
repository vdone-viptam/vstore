<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\User;
use App\Models\Warehouses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {
        return view('screens.manufacture.product.index', []);
    }

    public function create()
    {
        $this->v['v_stores'] = User::select('id', 'name')->where('role_id', 3)->orderBy('id', 'desc')->get();
        $this->v['categories'] = Category::select('id', 'name')->orderBy('id', 'desc')->get();
        $this->v['wareHouses'] = Warehouses::select('name', 'id')->where('user_id', Auth::id())->get();
        return view('screens.manufacture.product.create', $this->v);

    }

    public function add_product_to_ware(Request $request)
    {
        $this->v['wareHouses'] = Warehouses::select('name', 'id')->where('user_id', Auth::id())->get();

        return view('screens.manufacture.product.add_product_to_ware', $this->v);

    }

    public function store(Request $request)
    {
//        dd($request->all());
        DB::beginTransaction();

        try {
            $product = new Product();
            $product->vstore_id = $request->vstore_id;
            $product->name = $request->name;
            $product->discount = (float)$request->discount;
            $product->category_id = $request->category_id;
            $product->description = $request->description;
            $product->brand = $request->brand;
            $product->weight = $request->weight;
            $product->packing_type = $request->packing_type;
            $product->manufacturer_name = $request->manufacturer_name;
            $product->manufacturer_address = $request->manufacturer_address;
            $product->origin = $request->origin;
            $product->length = $request->length;
            $product->with = $request->with;
            $product->height = $request->height;
            $product->volume = $request->volume;
            $product->import_unit = $request->import_unit ?? '';
            $product->import_address = $request->import_address ?? '';
            $product->price = $request->price;
            $product->amount_product_send_to_discount = $request->amount_product_send_to_discount;
            $product->percent_discount = $request->percent_discount;
            $product->sku_id = $request->sku_id;
            $product->payment_on_delivery = $request->payment_on_delivery ? 1 : 0;
            $product->prepay = $request->prepay ? 1 : 0;
            $product->status = 1;
            $photo_gallery = [];
            foreach (json_decode($request->images) as $image) {
                $photo_gallery[] = $this->saveImgBase64($image, 'products');
            }
            $product->images = json_encode($photo_gallery);
            $product->user_id = Auth::id();
            $product->save();
            $dataInsert = [];

            for ($i = 0; $i < count($request->ward_id); $i++) {
                $dataInsert[] = [
                    'product_id' => $product->id,
                    'ware_id' => $request->ward_id[$i],
                    'amount' => $request->amount[$i],
                    'created_at' => Carbon::now(),
                    'status' => 1];
            }
            ProductWarehouses::insert($dataInsert);


            DB::commit();
            return redirect()->back()->with('success', 'Gửi yêu cầu thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');
        }
    }

    protected function saveImgBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        return $fileName;
    }

    public function requestProduct(Request $request)
    {
        $limit = $request->limit ?? 10;
        $request->page = $request->page1 > 0 ? $request->page1 : $request->page;
        if (isset($request->condition) && $request->condition != 0) {
            $condition = $request->condition;
            if ($condition == 'sku_id') {
                $this->v['products'] = Product::select('id', 'name', 'vstore_id', 'category_id', 'created_at', 'status')->where('sku_id', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);
            } else if ($condition == 'name') {
                $this->v['products'] = Product::select('id', 'name', 'vstore_id', 'category_id', 'created_at', 'status')->where('name', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);
            } else if ($condition == '3') {
                $this->v['products'] = Product::select('products.id', 'products.name', 'categories.name as cate_name', 'products.created_at', 'products.status', 'vstore_id')->join('categories', 'products.category_id', '=', 'categories.id')->where('categories.name', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);
            } else {
                $this->v['products'] = Product::select('id', 'name', 'vstore_id', 'category_id', 'created_at', 'status')->where('brand', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);

            }
        } else {
            $this->v['products'] = Product::select('id', 'name', 'vstore_id', 'category_id', 'created_at', 'status')->orderBy('id', 'desc')->paginate($limit);

        }
        if (isset($request->page) && $request->page > $this->v['products']->lastPage()) {
            abort(404);
        }

        $this->v['params'] = $request->all();
        return view('screens.manufacture.product.request', $this->v);

    }

    public function detail(Request $request)
    {
        $this->v['product'] = Product::select('id', 'name', 'vstore_id', 'category_id', 'created_at', 'status', 'discount', 'price')->where('id', $request->id)->first();
        $this->v['product']->amount_product = (int)DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2  AND product_id = $request->id) as amount FROM product_warehouses where status = 1 AND product_id = $request->id"))[0]->amount;
        return view('screens.manufacture.product.detail', $this->v);
    }
}
