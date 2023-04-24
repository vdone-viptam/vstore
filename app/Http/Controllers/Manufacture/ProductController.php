<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\BuyMoreDiscount;
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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $this->v['field'] = $request->field ?? 'products.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['products'] = Product::query()->select('products.id',
            'publish_id', 'images', 'products.name', 'category_id', 'price', 'products.status', 'vstore_id', 'categories.name as cate_name',
            'amount_product_sold')
            ->selectSub('select name from users where id = products.vstore_id', 'vstore_name')
            ->selectSub('select IFNULL(SUM(amount - export),0) from product_warehouses where product_id= products.id', 'amount')
            ->join("categories", 'products.category_id', '=', 'categories.id');
        $this->v['key_search'] = trim($request->key_search) ?? '';
        if (strlen($this->v['key_search'])) {
            $this->v['products'] = $this->v['products']->where(function ($query) {
                $query->where('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('publish_id', '=', $this->v['key_search'])
                    ->orWhere('brand', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $this->v['products'] = $this->v['products']->groupBy('products.id')
            ->where('user_id', Auth::id())
            ->orderBy($this->v['field'], $this->v['type'])
            ->paginate($this->v['limit']);

        $this->v['params'] = $request->all();
        return view('screens.manufacture.product.index', $this->v);
    }

    public function create()
    {
        $this->v['v_stores'] = User::select('id', 'name', 'account_code')->where('account_code', '!=', null)->where('role_id', 3)->orderBy('id', 'desc')->get();
        $this->v['categories'] = Category::select('id', 'name')->orderBy('id', 'desc')->get();
        $this->v['wareHouses'] = Warehouses::select('name', 'id')->where('user_id', Auth::id())->get();
        return view('screens.manufacture.product.createp', $this->v);

    }

    public function createRequest()
    {
//        return 1;
        $this->v['wareHouses'] = Warehouses::select('name', 'id')->where('user_id', Auth::id())->get();
        $this->v['products'] = Product::select('id', 'name')->where('status', 0)->where('user_id', Auth::id())->get();
        $this->v['vstore'] = User::where('id', 800)->first();

        if (!$this->v['vstore']) {
            $this->v['vstore'] = User::select('id', 'name')->where('provinceId', Auth::user()->provinceId)->where('branch', 2)->where('role_id', 3)->first();
        }
//        return $this->v['vstore'];
        $listVstores = User::select('id', 'name', 'account_code')->where('account_code', '!=', null)->where('id', '!=', $this->v['vstore']->id ?? 0)->where('role_id', 3)->where('branch', 2)->orderBy('id', 'desc')->get();
        $vstores = [];
        foreach ($listVstores as $list) {
            $vstores[] = $list;
        }
        $v = User::select('id', 'name', 'account_code')->where('account_code', '!=', null)->where('tax_code', Auth::user()->tax_code)->where('role_id', 3)->first();
        if ($v) {
            $vstores[] = $v;
        }
        $this->v['v_stores'] = array_unique($vstores);
//        return $this->v['v_stores'];
        return view('screens.manufacture.product.create', $this->v);

    }

    public function add_product_to_ware(Request $request)
    {
        $this->v['wareHouses'] = Warehouses::select('name', 'id')->where('user_id', Auth::id())->get();

        return view('screens.manufacture.product.add_product_to_ware', $this->v);

    }

    public function store(Request $request)
    {
        //    dd( $request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required|min:1',
            'sku_id' => 'required|max:255',
            'description' => 'required',
            'short_content' => 'required|max:500',
            'brand' => 'required|max:255',
            'origin' => 'required|max:255',
            'material' => 'required|max:255',
            'weight' => 'required|max:13',
            'length' => 'required|max:13',
            'height' => 'required|max:13',
            'packing_type' => 'required',
            'with' => 'required|max:13',
            'volume' => 'max:15',
            'manufacturer_name' => 'max:255',
            'manufacturer_address' => 'max:255',
            'import_unit' => 'max:255',
            'import_address' => 'max:255',
        ], [
            'name.max' => 'Tên sản phẩm ít hơn 255 ký tự',
            'name.required' => 'Tên sản phẩm bắt buộc nhập',
            'category_id.required' => 'Ngành hàng bắt buộc chọn',
            'price.required' => 'Giá sản phẩm bắt buộc nhập',
            'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 1',
            'sku_id.required' => 'Mã SKU bắt buộc nhập',
            'sku_id.max' => 'Mã SKU ít hơn 255 ký tự',
            'description.required' => 'Chi tiết sản phẩm bắt buộc nhập',
            'short_content.required' => 'Tóm tắt sản phẩm bắt buộc nhập',
            'short_content.max' => 'Tóm tắt sản phẩm it hơn 500 ký tự',
            'brand.required' => 'Thương hiệu sản phẩm bắt buộc nhập',
            'brand.max' => 'Thương hiệu sản phẩm ít hơn 255',
            'origin.required' => 'Xuất xứ sản phẩm bắt buộc nhập',
            'origin.max' => 'Xuất xứ sản phẩm ít hơn 255 ký tự',
            'material.required' => 'Chát liệu sản phẩm bắt buộc nhập',
            'material.max' => 'Chất liệu sản phẩm ít hơn 255 ký tự',
            'weight.required' => 'Trọng lượng sản phẩm bắt buộc nhập',
            'weight.max' => 'Trọng lượng sản phẩm ít hơn 10.000.000 gram',
            'length.required' => 'Chiều dài sản phẩm bắt buộc nhập',
            'length.max' => 'Chiều dài sản phẩm ít hơn 10.000.000 cm',
            'height.required' => 'Chiều cao sản phẩm bắt buộc nhập',
            'height.max' => 'Chiều cao sản phẩm ít hơn 10.000.000 cm',
            'packing_type.required' => 'Kiều đóng gói bắt buộc chọn',
            'with.required' => 'Chiều rộng sản phẩm bắt buộc nhập',
            'with.max' => 'Chiều rộng sản phẩm ít hơn 10.000.000 cm',
            'volume.max' => 'Thể tích sản phẩm ít hơn 100.000.000.000 ml',
            'manufacturer_name.max' => 'Tên nhà sản xuất ít hơn 255 ký tự',
            'manufacturer_address.max' => 'Địa chỉ nhà cung cấp 255 ký tự',
            'import_unit.max' => 'Tên nhà nhập khẩu ít hơn 255 ký tự',
            'import_address.max' => 'Địa chỉ nhà nhập khẩu ít hơn 255 ký tự',
        ]);
        if ($validator->fails()) {
//            dd($validator->errors());
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }
        DB::beginTransaction();

        try {
            $product = new Product();
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->price = str_replace('.', '', $request->price);
            $product->description = trim($request->description);
            $product->brand = $request->brand;
            $product->material = $request->material;
            $product->weight = str_replace('.', '', $request->weight);
            $product->short_content = trim($request->short_content);
            $product->manufacturer_name = $request->manufacturer_name;
            $product->unit_name = $request->unit_name;
            $product->import_date = $request->import_date;
            $product->origin = $request->origin;
            $product->length = str_replace('.', '', $request->length) ?? 0;
            $product->with = str_replace('.', '', $request->with) ?? 0;
            $product->height = str_replace('.', '', $request->height) ?? 0;
            $product->volume = str_replace('.', '', $request->volume) ?? 0;
            $product->import_unit = $request->import_unit ?? '';
            $product->import_address = $request->import_address ?? '';
            $product->packing_type = $request->packing_type;
            $product->availability_status = 0;
            $product->status = 0;
            $product->sku_id = $request->sku_id;
            // Upload Image
            if ($request->hasFile('video')) {
                $filenameWithExt = $request->file('video')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('video')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('video')->storeAs('public/products', $fileNameToStore);

                $path = str_replace('public/', '', $path);

                $product->video = 'storage/' . $path;
            }

            while (true) {
                $code = 'VN-' . Str::random(10);
                if (!Product::where('publish_id', $code)->first()) {
                    $product->publish_id = $code;
                    break;
                }
            }
            $photo_gallery = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filenameWithExt = $image->getClientOriginalName();
                    //Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $image->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $path = $image->storeAs('public/products', $fileNameToStore);

                    $path = str_replace('public/', '', $path);

                    $photo_gallery[] = 'storage/' . $path;
                }
                $product->images = json_encode($photo_gallery);
            }


            $product->user_id = Auth::id();
            $product->save();

            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra . Vui lòng thử lại');
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
        $this->v['field'] = $request->field ?? 'requests.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['key_search'] = $request->key_search ?? '';
        $limit = $request->limit ?? 10;
        $this->v['requests'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.vstore_id', '=', 'users.id')
            ->selectRaw('requests.code,
            requests.id,requests.created_at,requests.status,
            categories.name,products.name as product_name,
            users.name as user_name');
        if (strlen($this->v['key_search'])) {
            $this->v['requests'] = $this->v['requests']->where(function ($query) {
                $query->where('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('requests.code', '=', $this->v['key_search'])
                    ->orWhere('users.name', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $this->v['requests'] = $this->v['requests']
            ->where('requests.user_id', Auth::id())
            ->orderBy($this->v['field'], $this->v['type'])
            ->paginate($limit);
        $this->v['limit'] = $limit;
        return view('screens.manufacture.product.request', $this->v);

    }

    public function detail(Request $request)
    {

        try {

            if ($request->product) {

                try {
                    $product = Product::query()->select('products.id', 'products.name', 'categories.name as cate_name',
                        'products.price', 'short_content', 'images', 'video', 'availability_status', 'discount', 'discount_vShop', 'amount_product_sold', 'publish_id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->where('products.id', $request->product_id)
                        ->selectSub('select IFNULL(SUM(amount - export),0) from product_warehouses where product_id=' . $request->product_id, 'amount')
                        ->first();

                    return response()->json(['data' =>
                        view('screens.manufacture.product.detail_product',
                            ['product' => $product])->render(),
                        'id' => $product->id,
                        'availability_status' => $product->availability_status,
                    ]);
                } catch (\Exception $exception) {
                    return response()->json([
                        'success' => false,
                        'message' => $exception->getMessage()
                    ], 500);
                }

            } else {
                try {
                    $request = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
                        ->join('requests', 'products.id', '=', 'requests.product_id')
                        ->join('users', 'requests.vstore_id', '=', 'users.id')
                        ->selectRaw('requests.code,products.id,requests.id as re_id,price,
                    requests.discount,requests.discount_vshop,requests.status,products.name as product_name,
                    users.name as user_name,requests.note,publish_id,requests.created_at')
                        ->where('requests.id', $request->id)
                        ->first();
                    return response()->json(['view' =>
                        view('screens.manufacture.product.detail',
                            ['product' => $request])->render(),
                    ]);
                } catch (\Exception $exception) {
                    return response()->json([
                        'success' => false,
                        'message' => $exception->getMessage()
                    ], 500);
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
//            dd($e->getMessage());
        }
    }

    public function requestDeleteProduct()
    {
        return view('screens.manufacture.product.request_delete');
    }

    public function createp()
    {
        return view('screens.manufacture.product.createp');
    }

    public function storeRequest(Request $request)
    {

        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'vstore_id' => 'required',
                'product_id' => 'required',
                'discountA' => 'required',
                'role' => 'min:1',
                'prepay' => 'required',
                'vat' => 'required|min:1|max:99',


            ], [
                'vstore_id.required' => 'V-Store bắt buộc chọn',
                'product_id.required' => 'Sản phẩm kiểm duyệt bắt buộc chọn',
                'discountA.required' => 'Chiết khấu bắt buộc nhập',
                'role.min' => 'Vai trò với sản phẩm bắt buộc chọn',
                'prepay.required' => 'Phương thức thanh toán bắt buộc chọn',
                'vat.required' => 'VAT bắt buộc nhâp',
                'vat.min' => 'VAT nhỏ nhất 1',
                'vat.max' => 'VAT lớn nhất 99',

            ]);

            if ($request->sl[0] == '' || $request->moneyv[0] == '') {
                return redirect()->back()->withErrors(['sl' => 'Vui lòng nhập chiết khấu hàng nhập sẵn'])->withInput($request->all());
            }

            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }

            $object = new Application();
            $object->product_id = $request->product_id;
            $object->discount = $request->discountA;
            $object->role = $request->role;
            $object->status = 0;
            $object->vstore_id = $request->vstore_id;
            $object->vat = $request->vat;
            $object->user_id = Auth::id();
            $object->type_pay = $request->prepay;
            $object->prepay = $request->prepay;
//            $object->prepay = $request->prepay[0] == 1 ? 1 : 0;
//            $object->payment_on_delivery = isset($request->prepay[1]) && $request->prepay[1] == 2 || $request->prepay[0] == 2 ? 1 : 0;
            $code = rand(100000000000, 999999999999);

            while (true) {
                if (Application::where('code', $code)->count() > 0) {
                    $code = rand(100000000000, 999999999999);
                } else {
                    break;
                }

            }
            $object->code = $code;
            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filenameWithExt = $file->getClientOriginalName();
                    //Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $file->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $path = $file->storeAs('public/products', str_replace(' ', '', $fileNameToStore));

                    $path = str_replace('public/', '', $path);
                    $images[] = 'storage/' . $path;
                }
            }

            $object->images = json_encode($images);
//            return $object;
            $object->save();

            $product = Product::find($request->product_id);
//            return $request;

            if ($product) {
                $product->vstore_id = $request->vstore_id;
                $product->save();

                $sl = [];

                for ($i = 0; $i < 3; $i++) {

                    if (strlen($request->sl[$i]) > 0 && strlen($request->moneyv[$i]) > 0) {
                        $sl[] = [
                            'start' => $request->sl[$i],
                            'discount' => $request->moneyv[$i],
                            'product_id' => $product->id,
                            'deposit_money' => $request->deposit_money[$i] ?? 100,
                        ];
                    }

                }
                $tg = 0;
                for ($i = 0; $i < count($sl) - 1; $i++) {
                    for ($j = $i + 1; $j < count($sl); $j++) {
                        if ($sl[$i]['start'] > $sl[$j]['start']) {
                            $tg = $sl[$i];
                            $sl[$i] = $sl[$j];
                            $sl[$j] = $tg;
                        }
                    }
                }
                for ($i = 0; $i < count($sl); $i++) {
                    $start = $sl[$i];
                    if (array_key_exists($i + 1, $sl)) {
                        $sl[$i]['end'] = $sl[$i + 1]['start'];
                    } else {
                        $sl[$i]['end'] = 0;
                    }


                }

                DB::table('buy_more_discount')->insert($sl);
            }
            DB::table('products')->where('id', $request->product_id)->update(['status' => 1]);
            $userLogin = Auth::user();
            $user = User::find($request->vstore_id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo

            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => asset('image/users' . $userLogin->avatar) ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                'message' => $userLogin->name . ' đã gửi yêu cầu niêm yết sản phẩm đến bạn',
                'created_at' => Carbon::now()->format('h:i A d / m / Y'),
                'href' => route('screens.vstore.product.request',)
            ];
            $user->notify(new AppNotification($data));
            DB::commit();
            return redirect()->back()->with('success', 'Thêm mới yêu cầu niêm yết thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Thêm mới yêu cầu niêm yết thất bại');

        }

    }

    public function getDataProduct(Request $request)
    {
        $product = Product::select('price')->where('id', $request->product_id)->first();

        return $product->price;
    }

    public function edit($id = null)
    {
        $categories = Category::all();
        $product = Product::find($id);

        $images = [];
        foreach (json_decode($product->images) as $image) {
            $images[] = asset($image);
        }
        $images = json_encode($images);
        if (!$product) {
            return redirect()->back();
        }
        return view('screens.manufacture.product.edit', compact('categories', 'product', 'images'));
    }

    public function update($id, Request $request)
    {
        DB::beginTransaction();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required|min:1',
            'sku_id' => 'required|max:255',
            'description' => 'required',
            'short_content' => 'required|max:500',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'video' => 'max:512000|required',
            'brand' => 'required|max:255',
            'origin' => 'required|max:255',
            'material' => 'required|max:255',
            'weight' => 'required|max:13',
            'length' => 'required|max:13',
            'height' => 'required|max:13',
            'packing_type' => 'required',
            'with' => 'required|max:13',
            'volume' => 'max:15',
            'manufacturer_name' => 'max:255',
            'manufacturer_address' => 'max:255',
            'import_unit' => 'max:255',
            'import_address' => 'max:255',
        ], [
            'name.max' => 'Tên sản phẩm ít hơn 255 ký tự',
            'name.required' => 'Tên sản phẩm bắt buộc nhập',
            'category_id.required' => 'Ngành hàng bắt buộc chọn',
            'price.required' => 'Giá sản phẩm bắt buộc nhập',
            'price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 1',
            'sku_id.required' => 'Mã SKU bắt buộc nhập',
            'sku_id.max' => 'Mã SKU ít hơn 255 ký tự',
            'description.required' => 'Chi tiết sản phẩm bắt buộc nhập',
            'short_content.required' => 'Tóm tắt sản phẩm bắt buộc nhập',
            'short_content.max' => 'Tóm tắt sản phẩm it hơn 500 ký tự',
            'images.required' => 'Ảnh sản phẩm bắt buộc nhập',
            'images.image' => 'File nhập không phải định dạng ảnh',
            'images.mimes' => 'Đuôi file không được hô trợ upload (chỉ hỗ trợ các đuôi jpeg,png,jpg,gif,svg)',
            'video.required' => 'Video sản phẩm bắt buộc nhập ',
            'video.max' => 'Video sản phẩm vượt quá dung lượng cho phép 5GB',
            'brand.required' => 'Thương hiệu sản phẩm bắt buộc nhập',
            'brand.max' => 'Thương hiệu sản phẩm ít hơn 255',
            'origin.required' => 'Xuất xứ sản phẩm bắt buộc nhập',
            'origin.max' => 'Xuất xứ sản phẩm ít hơn 255 ký tự',
            'material.required' => 'Chát liệu sản phẩm bắt buộc nhập',
            'material.max' => 'Chất liệu sản phẩm ít hơn 255 ký tự',
            'weight.required' => 'Trọng lượng sản phẩm bắt buộc nhập',
            'weight.max' => 'Trọng lượng sản phẩm ít hơn 10.000.000 gram',
            'length.required' => 'Chiều dài sản phẩm bắt buộc nhập',
            'length.max' => 'Chiều dài sản phẩm ít hơn 10.000.000 cm',
            'height.required' => 'Chiều cao sản phẩm bắt buộc nhập',
            'height.max' => 'Chiều cao sản phẩm ít hơn 10.000.000 cm',
            'packing_type.required' => 'Kiều đóng gói bắt buộc chọn',
            'with.required' => 'Chiều rộng sản phẩm bắt buộc nhập',
            'with.max' => 'Chiều rộng sản phẩm ít hơn 10.000.000 cm',
            'volume.max' => 'Thể tích sản phẩm ít hơn 100.000.000.000 ml',
            'manufacturer_name.max' => 'Tên nhà sản xuất ít hơn 255 ký tự',
            'manufacturer_address.max' => 'Địa chỉ nhà cung cấp 255 ký tự',
            'import_unit.max' => 'Tên nhà nhập khẩu ít hơn 255 ký tự',
            'import_address.max' => 'Địa chỉ nhà nhập khẩu ít hơn 255 ký tự',
        ]);
        if ($validator->fails()) {
//            dd($validator->errors());
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }
        try {

            $product = Product::find($id);
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->price = str_replace('.', '', $request->price);
            $product->description = $request->description;
            $product->brand = $request->brand;
            $product->material = $request->material;
            $product->weight = str_replace('.', '', $request->weight);
            $product->manufacturer_name = $request->manufacturer_name;
            $product->unit_name = $request->unit_name;
            $product->import_date = $request->import_date;
            $product->origin = $request->origin;
            $product->length = str_replace('.', '', $request->length) ?? 0;
            $product->with = str_replace('.', '', $request->with) ?? 0;
            $product->height = str_replace('.', '', $request->height) ?? 0;
            $product->volume = str_replace('.', '', $request->volume) ?? 0;
            $product->import_unit = $request->import_unit ?? '';
            $product->import_address = $request->import_address ?? '';
            $product->packing_type = $request->packing_type;
            $product->sku_id = $request->sku_id;
            $product->status = 0;
            // Upload Image
            if ($request->hasFile('video')) {
                $filenameWithExt = $request->file('video')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('video')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('video')->storeAs('public/products', $fileNameToStore);

                $path = str_replace('public/', '', $path);

                $product->video = 'storage/' . $path;
            }


            if ($request->hasFile('images') && count($request->file('images') > 0)) {
                $photo_gallery = [];
                foreach ($request->file('images') as $image) {
                    $filenameWithExt = $image->getClientOriginalName();
                    //Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $image->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                    $path = $image->storeAs('public/products', $fileNameToStore);

                    $path = str_replace('public/', '', $path);

                    $photo_gallery[] = 'storage/' . $path;
                }
                $product->images = json_encode($photo_gallery);
            }

            $product->save();

            return redirect()->back()->with('success', 'Cập nhật thông tin sản phẩm thành công');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }

    public function uploadImagePost(Request $request)
    {
        $srcImage = asset('storage/products/' . $this->saveImgBase64($request->file, 'products'));
        return response()->json($srcImage);

    }

    public function checkDate(Request $request)
    {
        $to = Carbon::make($request->start_date);
        $from = Carbon::make($request->end_date);
        if ($to->diffInMinutes(Carbon::now()) < 10 && !$request->end_date) {
            return response()->json([
                'validated' => false,
                'error' => [
                    'end_date' => 'Thời gian bắt đầu phải sau 10 phút thời điểm hiện tại'
                ],
            ], 200);
        }
        if ($request->end_date) {
            if ($to->diffInMinutes(Carbon::now()) < 10 || Carbon::now() > $to) {
                return response()->json([
                    'validated' => false,
                    'error' => [
                        'end_date' => 'Thời gian bắt đầu phải sau 10 phút thời điểm hiện tại'
                    ],
                ], 200);
            }
            if ($from->diffInMinutes($to) < 10 || $from < $to) {
                return response()->json([
                    'validated' => false,
                    'error' => [
                        'end_date' => 'Thời gian kết thúc phải sau thời gian bắt đầu 10 phút'
                    ],
                ], 200);
            }
        }
        return response()->json([
            'validated' => true,
            'error' => [
                'end_date' => ''
            ],
        ], 200);
    }

    public function destroy($id = null)
    {
        $product = Product::where('id', $id)->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không có trong hệ thống, không thể xóa');
        }
        if ($product->availability_status == 1) {
            return redirect()->back()->with('error', 'Sản phẩm đã niêm yết không thể xóa');
        }

        Product::destroy($id);
        return redirect()->back()->with('success', 'Xóa sản phẩm thành công');
    }
}
