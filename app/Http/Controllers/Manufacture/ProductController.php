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
//        return 1;
        $this->v['products'] = Product::select('products.id',
            'publish_id', 'images', 'products.name', 'brand',
            'category_id', 'price', 'products.status', 'vstore_id', 'amount_product_sold')
            ->join("categories", 'products.category_id', '=', 'categories.id')
            ->orderBy('id', 'desc');
        $limit = $request->limit ?? 10;
        if ($request->condition && $request->condition != 0) {

            $this->v['products'] = $this->v['products']->where($request->condition, 'like', '%' . trim($request->key_search) . '%');
        }

        $this->v['products'] = $this->v['products']->orderBy('id', 'desc')
            ->where('user_id', Auth::id())
            ->paginate($limit);

        foreach ($this->v['products'] as $val) {
//            return $val->id;
            $val->amount_product = DB::select(DB::raw("SELECT SUM(amount) - SUM(export) AS amount FROM product_warehouses WHERE product_id =" . $val->id))[0]->amount;
//                return $val->amount_product;
//            $val->amount_product = DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2
//                    AND product_id = " . $val->id . ") as amount FROM product_warehouses
//                    where status = 1 AND product_id = " . $val->id))[0]->amount ?? 0;
        }
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
            'name' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'category_id' => 'required',
            'weight' => 'required',
            'video' => 'max:512000',
            'images' => 'required',
            'description' => 'required',
            'short_content' => 'required|max:500',
            'sku' => 'required',
            'length' => 'required',
            'height' => 'required',
            'packing_type' => 'required',
            'with' => 'required',
            'material' => 'required',
            'origin' => 'required'

        ], [
            'name.required' => 'Trường này không được trống',
            'price.required' => 'Trường này không được trống',
            'brand.required' => 'Trường này không được trống',
            'category_id.required' => 'Trường này không được trống',
            'weight.required' => 'Trường này không được trống',
            'video.max' => 'Video vượt quá dung lượng cho phép',
            'images.required' => 'Ảnh sản phẩm bắt buộc nhập',
            'description.required' => 'Chi tiết sản phẩm bắt buộc nhập',
            'short_content.required' => 'Mô tả sản phẩm bắt buộc nhập',
            'sku.required' => 'Mã SKU sản phẩm bắt buộc nhập',
            'length.required' => 'Chiều dài bắt buộc nhập',
            'height.required' => 'Chiều cao bắt buộc nhập',
            'packing_type.required' => 'Kiểu đóng gói bắt buộc nhập',
            'with.required' => 'Chiều dài bắt buộc nhập',
            'material.required' => 'Chất liệu bắt buộc nhập',
            'origin.required' => 'Xuất xứ bắt buộc nhập',
            'short_content.max' => 'Mô tả ngắn ít hơn 500 ký tự'
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
            $product->price = $request->price;
            $product->description = trim($request->description);
            $product->brand = $request->brand;
            $product->material = $request->material;
            $product->weight = $request->weight;
            $product->short_content = trim($request->short_content);
            $product->manufacturer_name = $request->manufacturer_name;
            $product->unit_name = $request->unit_name;
            $product->import_date = $request->import_date;
            $product->origin = $request->origin;
            $product->length = $request->length ?? 0;
            $product->with = $request->with ?? 0;
            $product->height = $request->height ?? 0;
            $product->volume = $request->volume ?? 0;
            $product->import_unit = $request->import_unit ?? '';
            $product->import_address = $request->import_address ?? '';
            $product->packing_type = $request->packing_type;
            $product->status = 0;
            $product->sku_id = $request->sku;
            // Upload Image
            if ($request->hasFile('video')) {
                $filenameWithExt = $request->file('video')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('video')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . ' . ' . $extension;
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

            foreach (json_decode($request->images) as $image) {
                try {
                    $photo_gallery[] = 'storage/products/' . $this->saveImgBase64($image, 'products');
                } catch (\Exception $exception) {
                    return redirect()->back();
//                    dd($exception->getMessage());
                }
            }
            $product->images = json_encode($photo_gallery);

            $product->user_id = Auth::id();
            $product->save();

            DB::commit();
            return redirect()->back()->with('success', 'Gửi yêu cầu thành công');
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
        $limit = $request->limit ?? 10;
        $this->v['requests'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.vstore_id', '=', 'users.id')
            ->selectRaw('requests.code,requests.id,requests.created_at,requests.status,categories.name,products.name as product_name,users.name as user_name');
        if ($request->condition && $request->condition != 0) {

            $this->v['requests'] = $this->v['requests']->where($request->condition, 'like', '%' . $request->key_search . '%');
        }

        $this->v['requests'] = $this->v['requests']
            ->where('requests.user_id', Auth::id())
            ->orderBy('requests.id', 'desc')
            ->paginate($limit);
//        dd($this->v['requests']);
        $this->v['params'] = $request->all();
        return view('screens.manufacture.product.request', $this->v);

    }

    public function detail(Request $request)
    {

        try {

            if ($request->product) {

                $this->v['product'] = Product::query()->select('id', 'publish_id', 'images',
                    'name', 'brand', 'category_id', 'price', 'status', 'vstore_id',
                    'discount', 'discount_vShop', 'description', 'vat', 'amount_product_sold')
                    ->selectSub('select amount - export from product_warehouses where product_id = products.id', 'amount')
                    ->where('id', $request->id)
                    ->first();
                return view('screens.manufacture.product.detail_product', $this->v);

            } else {
                $this->v['request'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
                    ->join('requests', 'products.id', '=', 'requests.product_id')
                    ->join('users', 'requests.vstore_id', '=', 'users.id')
                    ->selectRaw('requests.code,products.id,requests.id as re_id,price,
                    requests.discount,requests.discount_vshop,requests.status,products.name as product_name,
                    users.name as user_name,requests.vat,products.amount_product_sold')
                    ->where('requests.id', $request->id)
                    ->first();
                return view('screens.manufacture.product.detail', $this->v);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
//            dd($e->getMessage());
        }
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
                'discount' => 'required',
                'role' => 'min:1',
                'prepay' => 'required',
                'vat' => 'required|min:1|max:99',
                'deposit_money' => 'required|min:1',


            ], [
                'vstore_id.required' => 'V-store bắt buộc chọn',
                'product_id.required' => 'Sản phẩm kiểm duyệt bắt buộc chọn',
                'discount.required' => 'Chiết khấu bắt buộc nhập',
                'role.min' => 'Vai trò với sản phẩm bắt buộc chọn',
                'prepay.required' => 'Phương thức thanh toán bắt buộc chọn',
                'vat.required' => 'VAT bắt buộc nhâp',
                'vat.min' => 'VAT nhỏ nhất 1',
                'vat.max' => 'VAT lớn nhất 99',
                'deposit_money.required' => 'Tiền cọc khi nhập sẵn bắt buộc nhập',
                'deposit_money.min' => 'Tiền cọc khi nhập sẵn không được nhỏ hơn hoặc bằng 0',


            ]);

            if ($request->sl[0] == '' || $request->moneyv[0] == '') {
                return redirect()->back()->withErrors(['sl' => 'Vui lòng nhập chiết khấu hàng nhập sẵn'])->withInput($request->all());
            }

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }

            $object = new Application();
            $object->product_id = $request->product_id;
            $object->discount = $request->discount;
            $object->role = $request->role;
            $object->status = 0;
            $object->vstore_id = $request->vstore_id;
            $object->vat = $request->vat;
            $object->user_id = Auth::id();
            $object->type_pay = $request->prepay == 1 ? 2 : 1;
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
                foreach ($request->images as $file) {
                    $filenameWithExt = $file->getClientOriginalName();
                    //Get just filename
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    // Get just ext
                    $extension = $file->getClientOriginalExtension();
                    // Filename to store
                    $fileNameToStore = $filename . '_' . time() . ' . ' . $extension;
                    $path = $file->storeAs('public/products', str_replace(' ', '', $fileNameToStore));

                    $path = str_replace('public/', '', $path);

                    $images[] = 'storage / ' . $path;
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
//                   $end = $sl[$i+1]??0;

                }

                DB::table('buy_more_discount')->insert($sl);

//                return $product;
            }
//            $dataInsert = [];
//            for ($i = 0; $i < count($request->ward_id); $i++) {
//                $dataInsert[] = [
//                    'product_id' => $request->product_id,
//                    'ward_id' => $request->ward_id[$i],
//                    'amount' => $request->amount[$i],
//                    'created_at' => Carbon::now(),
//                    'status' => 3];
//            }
//            ProductWarehouses::insert($dataInsert);
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
            return redirect()->back()->with('success', 'Thêm mới yêu cầu đăng ký thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Thêm mới yêu cầu đăng ký thất bại');

        }

    }

    public function getDataProduct(Request $request)
    {
        $product = Product::select('price')->where('id', $request->product_id)->first();

        return $product->price;
    }

    public function edit($id)
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'category_id' => 'required',
            'weight' => 'required',
            'images' => 'required',
            'description' => 'required',
            'sku' => 'required',
            'length' => 'required',
            'height' => 'required',
            'packing_type' => 'required',
            'with' => 'required',
            'material' => 'required',
            'origin' => 'required',
            'short_content' => 'required|max:500'

        ], [
            'name.required' => 'Trường này không được trống',
            'price.required' => 'Trường này không được trống',
            'brand.required' => 'Trường này không được trống',
            'category_id.required' => 'Trường này không được trống',
            'weight.required' => 'Trường này không được trống',
            'images.required' => 'Ảnh sản phẩm bắt buộc nhập',
            'description.required' => 'Mô tả bắt buộc nhập',
            'sku.required' => 'Mã SKU sản phẩm bắt buộc nhập',
            'length.required' => 'Chiều dài bắt buộc nhập',
            'height.required' => 'Chiều cao bắt buộc nhập',
            'packing_type.required' => 'Kiểu đóng gói bắt buộc nhập',
            'with.required' => 'Chiều dài bắt buộc nhập',
            'material.required' => 'Chất liệu bắt buộc nhập',
            'origin.required' => 'Xuất xứ bắt buộc nhập',
            'short_content.max' => 'Mô tả ngắn ít hơn 500 ký tự',
            'short_content.required' => 'Mô tả ngắn bắt buộc nhập'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all())->with('validate', 'failed');
        }
        try {

            $product = Product::find($id);
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->brand = $request->brand;
            $product->material = $request->material;
            $product->weight = $request->weight;
            $product->manufacturer_name = $request->manufacturer_name;
            $product->unit_name = $request->unit_name;
            $product->import_date = $request->import_date;
            $product->origin = $request->origin;
            $product->length = $request->length ?? 0;
            $product->with = $request->with ?? 0;
            $product->height = $request->height ?? 0;
            $product->volume = $request->volume ?? 0;
            $product->import_unit = $request->import_unit ?? '';
            $product->import_address = $request->import_address ?? '';
            $product->packing_type = $request->packing_type;
            $product->sku_id = $request->sku;
            $product->status = 0;
            // Upload Image
            if ($request->hasFile('video')) {
                $filenameWithExt = $request->file('video')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('video')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . ' . ' . $extension;
                $path = $request->file('video')->storeAs('public/products', $fileNameToStore);

                $path = str_replace('public/', '', $path);

                $product->video = 'storage/' . $path;
            }
            $photo_gallery = [];

            foreach (json_decode($request->images) as $image) {
                try {
                    if (strpos($image, 'storage/products') !== false) {
                        $photo_gallery[] = explode(config('domain.ncc') . "/", $image)[1];
                    } else {
                        $photo_gallery[] = 'storage/products/' . $this->saveImgBase64($image, 'products');

                    }
                } catch (\Exception $exception) {
                    return redirect()->back();
                }
            }
            $product->images = json_encode($photo_gallery);
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
}
