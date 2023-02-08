<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $this->v['products'] = Product::select('id', 'publish_id', 'images', 'name', 'brand', 'category_id', 'price', 'status', 'vstore_id')
            ->orderBy('id', 'desc')
            ->where('user_id', Auth::id())
            ->pagiate(10);
        dd($this->v['products']);
        return view('screens.admin.product.index', $this->v);

    }

    public function detail(Request $request)
    {
        $product = Product::select('id', 'name', 'user_id', 'category_id', 'created_at', 'status', 'discount', 'price', 'admin_confirm_date', 'discount_vShop')->where('id', $request->id)->orderBy('created_at', 'desc')->first();
        $product->amount_product = (int)DB::select(DB::raw("SELECT SUM(amount)  - (SELECT IFNULL(SUM(amount),0) FROM product_warehouses WHERE status = 2  AND product_id = $request->id) as amount FROM product_warehouses where status = 1 AND product_id = $request->id"))[0]->amount;
        return view('screens.admin.product.detail', compact('product'));
    }

    public function confirm($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::find($id);
            $product->status = $request->status;
            $product->admin_confirm_date = Carbon::now();
            if (isset($request->note)) {
                $product->note = $request->note;
            }
            $product->save();
            $userLogin = Auth::user();
            $user = User::find($product->user_id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
            $message = 'Quản trị viên đã từ chối yêu cầu niêm yết sản phẩm đến bạn';
            if ($request->status == 2) {
                $message = 'Quản trị viên đã đồng ý yêu cầu niêm yết sản phẩm đến bạn';
            }
            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => $userLogin->avatar ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                'message' => $message,
                'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => route('screens.manufacture.product.request', ['condition' => 'sku_id', 'key_search' => $product->sku_id])
            ];
            $user->notify(new AppNotification($data));
            $userVstore = User::find($product->vstore_id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
            $data['href'] = route('screens.vstore.product.request', ['condition' => 'sku_id', 'key_search' => $product->sku_id]);
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
