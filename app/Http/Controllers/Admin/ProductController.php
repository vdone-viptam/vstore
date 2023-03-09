<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\BuyMoreDiscount;
use App\Models\Product;
use App\Models\User;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $limit = $request->limit ?? 10;
        $this->v['requests'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->selectRaw('products.name as product_name,publish_id,categories.name as name,requests.id,requests.status,users.name as user_name,requests.created_at');


        if (isset($request->keyword)) {
            $this->v['requests'] = $this->v['requests']
                ->orWhere('products.name', 'like', '%' . $request->keyword . '%')
                ->orWhere('publish_id', $request->keyword)
                ->orWhere('categories.name', 'like', '%' . $request->keyword . '%')
                ->orWhere('users.name', 'like', '%' . $request->keyword . '%');
        }
        $this->v['requests'] = $this->v['requests']->whereNotIn('requests.status', [2, 0])->orderBy('requests.id', 'desc')
            ->paginate($limit);
        $a = $this->v['requests']->total();
        foreach ($this->v['requests'] as $key => $val) {
            if (!in_array((int)$val->status, [1, 3, 4])) {
                unset($this->v['requests'][$key]);
                $a -= 1;
            }
        }
        if ($request->keyword) {
            $this->v['total'] = $a;
        }
        $this->v['params'] = $request->all();
        return view('screens.admin.product.index', $this->v);

    }

    public function detail(Request $request)
    {
        $this->v['request'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->selectRaw('requests.code,requests.id,price,requests.discount,requests.discount_vshop,requests.status,products.name as product_name,users.name as user_name,requests.note,publish_id,products.id as pro_id')
            ->where('requests.id', $request->id)
            ->first();
        $this->v['request']->amount_product = (int)DB::select(DB::raw("SELECT SUM(amount) as amount FROM product_warehouses where status = 3 AND product_id = " . $this->v['request']->pro_id))[0]->amount;
        return view('screens.admin.product.detail', $this->v);
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
            $message = 'Quản trị viên đã từ chối yêu cầu niêm yết sản phẩm đến bạn';
            if ($request->status == 3) {
                $message = 'Quản trị viên đã đồng ý yêu cầu niêm yết sản phẩm đến bạn';
                DB::table('products')->where('id', $currentRequest->product_id)->update([
                    'admin_confirm_date' => Carbon::now(),
                    'status' => 2,
                    'vat' => $currentRequest->vat,
                    'discount' => $currentRequest->discount,
                    'discount_vShop' => $currentRequest->discount_vshop,
                    'prepay' => $currentRequest->prepay,
                    'payment_on_delivery' => $currentRequest->payment_on_delivery,
                    'deposit_money'=>$currentRequest->deposit_money,
                ]);
                DB::table('product_warehouses')->where('product_id', $currentRequest->product_id)->where('status', 3)->update(['status' => 1]);
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
                'href' => route('screens.manufacture.product.request')
            ];
            $user->notify(new AppNotification($data));
            $userVstore = User::find($currentRequest->vstore_id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
            $data['href'] = route('screens.vstore.product.request');
            $userVstore->notify(new AppNotification($data));
            DB::commit();
            return redirect()->back()->with('success', 'Thay đổi trạng thái yêu cầu thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại !');

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
}
