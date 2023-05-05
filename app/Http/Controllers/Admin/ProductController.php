<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\BuyMoreDiscount;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use App\Models\VshopProduct;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {

        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $this->v['field'] = $request->field ?? 'requests.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['requests'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->selectSub('select name from users where id=requests.vstore_id limit 1', 'vstore_name')
            ->selectRaw('products.name as product_name,publish_id,categories.name as name,requests.id,requests.status,users.name as user_name,requests.created_at,requests.discount,requests.discount_vShop,requests.code');


        if (strlen($this->v['key_search']) > 0) {
            $user = User::select('id')->where('name', 'like', '%' . $this->v['key_search'] . '%')->where('role_id', 3)->first();
            if ($user) {
                $this->v['requests'] = $this->v['requests']->where('requests.vstore_id', $user->id);
            } else {
                $this->v['requests'] = $this->v['requests']->where(function ($query) use ($request) {
                    $query->orWhere('products.name', 'like', '%' . $this->v['key_search'] . '%')
                        ->orWhere('requests.code', $this->v['key_search'])
                        ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%')
                        ->orWhere('users.name', 'like', '%' . $this->v['key_search'] . '%');
                });
            }
        }

        $this->v['requests'] = $this->v['requests']->whereNotIn('requests.status', [2, 0])->orderBy($this->v['field'], $this->v['type'])
            ->paginate($this->v['limit']);

        return view('screens.admin.product.index', $this->v);

    }

    public function detail(Request $request)
    {
        if ($request->type == 2) {
            try {

                $product = Product::query()->select('products.id', 'products.name', 'categories.name as cate_name',
                    'products.price', 'short_content', 'images', 'video', 'products.status', 'discount', 'discount_vShop', 'amount_product_sold', 'publish_id', 'admin_confirm_date', 'products.vat')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->where('products.id', $request->id)
                    ->selectSub('select IFNULL(SUM(amount - export),0) from product_warehouses where product_id=' . $request->id, 'amount')
                    ->first();

                return response()->json(['view' =>
                    view('screens.admin.product.detail_product',
                        ['product' => $product])->render(),
                ]);
            } catch (\Exception $exception) {
                return response()->json([
                    'success' => false,
                    'message' => $exception->getMessage()
                ], 500);
            }
        } else {
            $this->v['product'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
                ->join('requests', 'products.id', '=', 'requests.product_id')
                ->join('users', 'requests.user_id', '=', 'users.id')
                ->selectRaw('requests.code,
                requests.id,price,
                requests.discount,
                requests.discount_vshop,
                requests.status,
                products.name,
                products.images,products.video,
                categories.name as cate_name,
                users.name as user_name,
                short_content,
                requests.note,
                requests.vat')
                ->where('requests.id', $request->id)
                ->first();
            return response()->json(['view' => view('screens.admin.product.detail', $this->v)->render()]);
        }
    }

    public function confirm($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $currentRequest = Application::find($id);
            $currentRequest->status = $request->status;
            if (isset($request->note)) {
                $currentRequest->note = $request->note;
            }
            $currentRequest->save();
            $userLogin = Auth::user();
            $user = User::find($currentRequest->user_id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
            $message = 'Quản trị viên đã từ chối yêu cầu niêm yết sản phẩm của bạn';
            $vstore = User::join('products', 'users.id', '=', 'products.vstore_id')->where('products.vstore_id', $currentRequest->vstore_id)
                ->where('products.id', $currentRequest->product_id)
                ->select('products.id', 'products.publish_id', 'users.account_code')->first();
            if ($request->status == 3) {


                $repon = Http::post(config('domain.domain_vdone') . 'notifications/send-all',
                    [
                        "message" => "Sản phẩm " . $vstore->publish_id . " đã được niêm yết tại V-Store " . $vstore->account_code,
                        "productId" => $vstore->id,
                        "type" => 9
                    ]
                );


                $message = 'Quản trị viên đã đồng ý yêu cầu niêm yết sản phẩm của bạn';
                DB::table('products')->where('id', $currentRequest->product_id)->update([
                    'admin_confirm_date' => Carbon::now(),
                    'status' => 2,
                    'vat' => $currentRequest->vat,
                    'discount' => $currentRequest->discount,
                    'discount_vShop' => $currentRequest->discount_vshop,
                    'prepay' => $currentRequest->prepay,
                    'payment_on_delivery' => $currentRequest->payment_on_delivery,
                    'deposit_money' => $currentRequest->deposit_money,
                    'type_pay' => $currentRequest->type_pay,
                ]);
            } else {
                DB::table('products')->where('id', $currentRequest->product_id)->update([
                    'admin_confirm_date' => Carbon::now(),
                    'status' => 0,
                    'vstore_id' => null
                ]);
                $deleteByMore = BuyMoreDiscount::where('product_id', $currentRequest->product_id)->delete();
            }
            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => asset('image/users' . $userLogin->avatar) ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                'message' => $message,
                'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => route('screens.manufacture.product.request', ['key_search' => $currentRequest->code])
            ];
            $user->notify(new AppNotification($data));
            $userVstore = User::find($currentRequest->vstore_id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
            $data['href'] = route('screens.vstore.product.request', ['key_search' => $currentRequest->code]);
            $userVstore->notify(new AppNotification($data));
            DB::commit();
            return redirect()->back()->with('success', 'Thay đổi trạng thái yêu cầu thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());

        }
    }

    public function genderCodeProduct($id)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);

            $code = 'VN-' . Str::random(10);
            $check = true;
            while ($check) {
                $checkProduct = Product::where('publish_id', $code)->count();
                if (!$checkProduct || $checkProduct < 1) {
                    $check = false;
                }
                $code = 'VN' . rand(1000000000, 9999999999);
            }
            $product->publish_id = $code;
            $product->save();

            Mail::send('email.email', ['id' => $code], function ($message) use ($product) {
                $message->to($product->NCC->email);
                $message->subject('Hóa đơn cần thanh toán');
            });
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mã sản phẩm thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra vui lòng thử lại');

        }
    }

    public function allProduct(Request $request)
    {
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['field'] = $request->field ?? 'amount_product_sold';
        $type = $request->type ?? 'asc';
        $this->v['products'] = Category::join('products', 'categories.id', '=', 'products.category_id')->join('users', 'products.user_id', '=', 'users.id')
            ->select('products.publish_id', 'products.category_id', 'products.user_id', 'products.discount', 'products.discount_vShop',
                'products.amount_product_sold', 'products.vstore_id', 'products.admin_confirm_date', 'users.name', 'products.id', 'categories.name as category_name')
            ->selectSub('select name from users where id =  products.vstore_id', 'vstore_name')
            ->selectSub('select IFNULL(sum(amount - export ),0) from product_warehouses where product_id =  products.id', 'amount')
            ->where('products.status', 2)
            ->orderBy($this->v['field'], $this->v['type']);
        if ($this->v['key_search'] != '') {
            $user = User::select('id')->where('name', 'like', '%' . $this->v['key_search'] . '%')->where('role_id', 3)->first();
            if ($user) {
                $this->v['products'] = $this->v['products']->where('products.vstore_id', $user->id);
            } else {
                $this->v['products'] = $this->v['products']->where(function ($query) {
                    $query->where('products.publish_id', $this->v['key_search'])
                        ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%')
                        ->orWhere('users.name', 'like', '%' . $this->v['key_search'] . '%');
                });
            }

        }

        $this->v['products'] = $this->v['products']->paginate($this->v['limit']);
        return view('screens.admin.product.all-product', $this->v);
    }
}
