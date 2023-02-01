<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\User;
use App\Models\Warehouses;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $request->page = $request->page1 > 0 ? $request->page1 : $request->page;
        if (isset($request->condition) && $request->condition != 0) {
            $condition = $request->condition;
            if ($condition == 'sku_id') {
                $this->v['products'] = Product::select('code', 'id', 'sku_id', 'name', 'vstore_id', 'category_id', 'created_at', 'brand', 'images', 'amount_product', 'price', 'admin_confirm_date', 'vstore_confirm_date')->where('admin_confirm_date', '!=', null)->where('sku_id', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);
            } else if ($condition == 'name') {
                $this->v['products'] = Product::select('code', 'id', 'sku_id', 'name', 'vstore_id', 'category_id', 'created_at', 'brand', 'images', 'amount_product', 'price', 'admin_confirm_date', 'vstore_confirm_date')->where('admin_confirm_date', '!=', null)->where('name', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);
            } else if ($condition == '3') {
                $this->v['products'] = Product::select('code', 'products.id', 'sku_id', 'products.name', 'categories.name as cate_name', 'products.created_at', 'vstore_id', 'brand', 'images', 'amount_product', 'price', 'admin_confirm_date', 'vstore_confirm_date')->join('categories', 'products.category_id', '=', 'categories.id')->where('admin_confirm_date', '!=', null)->where('categories.name', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);
            } else {
                $this->v['products'] = Product::select('code', 'id', 'sku_id', 'name', 'vstore_id', 'category_id', 'created_at', 'status', 'brand', 'images', 'amount_product', 'price', 'admin_confirm_date', 'vstore_confirm_date')->where('admin_confirm_date', '!=', null)->where('brand', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);

            }
        } else {
            $this->v['products'] = Product::select('code', 'id', 'sku_id', 'name', 'vstore_id', 'category_id', 'created_at', 'brand', 'images', 'amount_product', 'price', 'admin_confirm_date', 'vstore_confirm_date')->where('admin_confirm_date', '!=', null)->orderBy('id', 'desc')->paginate($limit);

        }
        if (isset($request->page) && $request->page > $this->v['products']->lastPage()) {
            abort(404);
        }

        $this->v['params'] = $request->all();
        return view('screens.manufacture.product.index', $this->v);
    }

    public function create()
    {
        $this->v['v_stores'] = User::select('id', 'name')->where('account_code', '!=', null)->where('role_id', 3)->orderBy('id', 'desc')->get();
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'vstore_id' => 'required',
            'discount' => 'required|max:99|min:0',
            'category_id' => 'required',
            'description' => 'required',
            'brand' => 'required',
            'weight' => 'required',
            'packing_type' => 'required',
            'manufacturer_name' => 'required',
            'manufacturer_address' => 'required',
            'origin' => 'required',
            'volume' => 'required',
            'price' => 'required',
            'sku_id' => 'required|unique:products',

        ], [
            'name.required' => 'Trường này không được trống',
            'company_name.required' => 'Trường này không được trống',
            'discount.required' => 'Trường này không được trống',
            'category_id.required' => 'Trường này không được trống',
            'description.required' => 'Trường này không được trống',
            'brand.regex' => 'Trường này không được trống',
            'weight.required' => 'Trường này không được trống',
            'packing_type.required' => 'Trường này không được trống',
            'manufacturer_name.required' => 'Trường này không được trống',
            'manufacturer_address.required' => 'Trường này không được trống',
            'origin.required' => 'Trường này không được trống',
            'volume.required' => 'Trường này không được trống',
            'price.required' => 'Trường này không được trống',
            'sku_id.required' => 'Trường này không được trống',


        ]);
        if ($validator->fails()) {
            dd($validator->errors());
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }
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
            $product->length = $request->length ?? 0;
            $product->with = $request->with ?? 0;
            $product->height = $request->height ?? 0;
            $product->volume = $request->volume ?? 0;
            $product->import_unit = $request->import_unit ?? '';
            $product->import_address = $request->import_address ?? '';
            $product->price = $request->price;
            $product->amount_product_send_to_discount = $request->amount_product_send_to_discount;
            $product->percent_discount = $request->percent_discount;
            $product->sku_id = $request->sku_id;
            $product->payment_on_delivery = $request->payment_on_delivery ? 1 : 0;
            $product->prepay = $request->prepay ? 1 : 0;
            $product->status = 1;
            $product->import_date = $request->import_date;
            $product->unit = $request->unit;
            $product->unit_name = $request->unit_name;
            while (true) {
                $code = rand(10000000, 99999999);
                if (!Product::where('code', $code)->first()) {
                    $product->code = $code;
                    break;
                }
            }
            $photo_gallery = [];
            foreach (json_decode($request->images) as $image) {
                $photo_gallery[] = $this->saveImgBase64($image, 'products');
            }
            $product->images = json_encode($photo_gallery);
            $photo_gallery = [];
            foreach (json_decode($request->unitImages) as $image) {
                $photo_gallery[] = $this->saveImgBase64($image, 'products');
            }
            $product->unit_images = json_encode($photo_gallery);
            $product->user_id = Auth::id();
            $product->save();

            $dataInsert = [];
            $amount = 0;
            for ($i = 0; $i < count($request->ward_id); $i++) {
                $dataInsert[] = [
                    'product_id' => $product->id,
                    'ware_id' => $request->ward_id[$i],
                    'amount' => $request->amount[$i],
                    'created_at' => Carbon::now(),
                    'status' => 1];
                $amount += $request->amount[$i];
            }
            ProductWarehouses::insert($dataInsert);
            Product::where('id', $product->id)->update(['amount_product' => $amount]);
            $userLogin = Auth::user();
            $user = User::find($request->vstore_id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => $userLogin->avatar ?? '',
                'message' => $userLogin->name . ' đã gửi yêu cầu niêm yết sản phẩm đến bạn',
                'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => route('screens.vstore.product.request', ['condition' => 'sku_id', 'key_search' => $product->sku_id])
            ];
            $user->notify(new AppNotification($data));
            DB::commit();
            return redirect()->back()->with('success', 'Gửi yêu cầu thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
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
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $limit = $request->limit ?? 10;
        $request->page = $request->page1 > 0 ? $request->page1 : $request->page;
        if (isset($request->condition) && $request->condition != 0) {
            $condition = $request->condition;
            if ($condition == 'sku_id') {
                $this->v['products'] = Product::select('code', 'id', 'sku_id', 'name', 'vstore_id', 'category_id', 'created_at', 'status', 'vstore_confirm_date', 'admin_confirm_date')->where('sku_id', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);
            } else if ($condition == 'name') {
                $this->v['products'] = Product::select('code', 'id', 'sku_id', 'name', 'vstore_id', 'category_id', 'created_at', 'status', 'vstore_confirm_date', 'admin_confirm_date')->where('name', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);
            } else if ($condition == '3') {
                $this->v['products'] = Product::select('code', 'products.id', 'sku_id', 'products.name', 'categories.name as cate_name', 'products.created_at', 'products.status', 'vstore_id', 'vstore_confirm_date', 'admin_confirm_date')->join('categories', 'products.category_id', '=', 'categories.id')->where('categories.name', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);
            } else {
                $this->v['products'] = Product::select('code', 'id', 'sku_id', 'name', 'vstore_id', 'category_id', 'created_at', 'status', 'vstore_confirm_date', 'admin_confirm_date')->where('brand', 'like', '%' . $request->key_search . '%')->orderBy('id', 'desc')->paginate($limit);

            }
        } else {
            $this->v['products'] = Product::select('code', 'id', 'sku_id', 'name', 'vstore_id', 'category_id', 'created_at', 'status', 'vstore_confirm_date', 'admin_confirm_date')->orderBy('id', 'desc')->paginate($limit);

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
