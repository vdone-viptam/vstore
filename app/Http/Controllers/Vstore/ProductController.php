<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\BuyMoreDiscount;
use App\Models\Product;
use App\Models\User;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
//        return 1;
        $limit = $request->limit ?? 10;
        $this->v['products'] = Product::join('users', 'products.user_id', '=', 'users.id')->join('categories', 'products.category_id', '=', 'categories.id')->where('products.status', 2)->where('vstore_id', Auth::id())
            ->select('products.publish_id', 'products.name as name', 'users.name as user_name', 'products.price', 'categories.name as cate_name', 'products.discount as discount');

        if ($request->condition && $request->condition != 0) {
            $this->v['products'] = $this->v['products']->where($request->condition, 'like', '%' . $request->key_search . '%');
        }
        $this->v['products'] = $this->v['products']->orderBy('products.id', 'desc')
            ->paginate($limit);
//return  $this->v['products'];
        $this->v['params'] = $request->all();

        return view('screens.vstore.product.index', $this->v);
    }

    public function request(Request $request)
    {
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $limit = $request->limit ?? 10;
        $this->v['requests'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->selectRaw('requests.code,requests.id,requests.created_at,requests.status,categories.name,products.name as product_name,users.name as user_name')
            ->where('requests.vstore_id', Auth::id());
        if ($request->condition && $request->condition != 0) {
            $this->v['requests'] = $this->v['requests']->where($request->condition, 'like', '%' . $request->key_search . '%');
        }
        $this->v['requests'] = $this->v['requests']->orderBy('requests.id', 'desc')
            ->paginate($limit);

        $this->v['params'] = $request->all();
        return view('screens.vstore.product.request', $this->v);
    }

    public function detail(Request $request)
    {
        $this->v['request'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->selectRaw('requests.code,requests.id,price,requests.discount,requests.discount_vshop,requests.status,products.name as product_name,users.name as user_name,requests.note')
            ->where('requests.id', $request->id)
            ->first();
        $this->v['request']->amount_product = (int)DB::select(DB::raw("SELECT SUM(amount) as amount FROM product_warehouses where status = 3 AND product_id = $request->id"))[0]->amount;
        return view('screens.vstore.product.detail', $this->v);
    }

    public function confirm($id, Request $request)
    {
        $currentRequest = Application::find($id);
        $currentRequest->status = $request->status;


        if (isset($request->discount_vShop)) {
            if ($request->discount_vShop < ($currentRequest->discount / 2)) {
                return redirect()->back()->with('error', 'validated');
            }
            $currentRequest->discount_vshop = $request->discount_vShop;
        }
        if (isset($request->note)) {
            $currentRequest->note = $request->note;
        }
        $currentRequest->save();
        DB::table('products')->where('id', $currentRequest->product_id)->update(['vstore_confirm_date' => Carbon::now()]);
        $userLogin = Auth::user();
        $user = User::find($currentRequest->user_id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
        $message = $request->status == 2 ? $userLogin->name . ' đã đồng yêu cầu niêm yết sản phẩm đến bạn và gửi yêu cầu tới quản trị viên' : $userLogin->name . ' đã từ chối yêu cầu niêm yết sản phẩm của bạn';

        $data = [
            'title' => 'Bạn vừa có 1 thông báo mới',
            'avatar' => asset('image/users' . $userLogin->avatar) ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
            'message' => $message,
            'created_at' => Carbon::now()->format('h:i A d/m/Y'),
            'href' => route('screens.manufacture.product.request')
        ];
        $user->notify(new AppNotification($data));

        if ($request->status == 1) {
            $admin = User::where('role_id', 1)->first();
            $user = User::find($admin->id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => asset('image/users' . $userLogin->avatar) ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                'message' => $currentRequest->NCC->name . ' đã gửi yêu cầu niêm yết sản phẩm đến bạn',
                'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => route('screens.admin.product.index')
            ];

            $user->notify(new AppNotification($data));
        } else {
            DB::table('products')->where('id', $currentRequest->product_id)->update([
                'status' => 0,
                'vstore_id' => null
            ]);
            $deleteByMore = BuyMoreDiscount::where('product_id', $currentRequest->product_id)->delete();
        }

        return redirect()->back()->with('success', 'Thay đổi trạng thái yêu cầu thành công');
    }

    public function discount()
    {
        $this->v['discounts'] = DB::table('discounts')->select('discounts.id', 'discounts.discount', 'products.name', 'discounts.created_at', 'start_date', 'end_date')
            ->join('products', 'discounts.product_id', '=', 'products.id')
            ->where('discounts.user_id', Auth::id())
            ->paginate(10);
        return view('screens.vstore.product.discount', $this->v);

    }

    public function createDis()
    {
        $product = DB::table('products')->select('name', 'id')->where('status', 2)->where('vstore_id', Auth::id())->get();
        $data = [];
        foreach ($product as $pr) {
            if (DB::table('discounts')->where('user_id', Auth::id())->where('product_id', $pr->id)->count() == 0) {
                $data[] = $pr;
            }
        }
        $this->v['products'] = $data;
        return view('screens.vstore.product.createDis', $this->v);

    }

    public function chooseProduct(Request $request)
    {
        $pro = DB::table('products')->select('price', 'discount', 'discount_vShop')->where('id', $request->product_id)->first();
        if ($pro) {
            $pro->price = number_format($pro->price, 0, '.', '.') ?? 0;
            return $pro;
        } else {
            return null;
        }

    }

    public function storeDis(Request $request)
    {


        DB::table('discounts')->insert([
            'product_id' => $request->product_id,
            'discount' => $request->discount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => 2,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('screens.vstore.product.discount')->with('success', 'Thêm mới giảm giá thành công');
    }

    public function editDis(Request $request)
    {

        $product = DB::table('products')->select('name', 'id')->where('status', 2)->where('vstore_id', Auth::id())->get();
        $data = [];
        foreach ($product as $pr) {
            if (DB::table('discounts')->where('user_id', Auth::id())->where('product_id', $pr->id)->count() == 0) {
                $data[] = $pr;
            }
        }

        $this->v['products'] = $data;
        $this->v['discount'] = DB::table('discounts')->select('id', 'product_id', 'start_date', 'end_date', 'start_date', 'discount')->where('id', $request->id)->first();
        $this->v['product1'] = Product::select('discount', 'discount_vShop', 'price', 'name', 'id')->where('id', $this->v['discount']->product_id)->first();
        return view('screens.vstore.product.editDis', $this->v);

    }

    public function updateDis($id, Request $request)
    {


        DB::table('discounts')
            ->where('id', $id)
            ->update([
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

        return redirect()->route('screens.vstore.product.discount')->with('success', 'Cập nhật giảm giá thành công');
    }
}
