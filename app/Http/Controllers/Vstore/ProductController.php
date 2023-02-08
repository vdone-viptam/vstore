<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Product;
use App\Models\User;
use App\Notifications\AppNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function request(Request $request)
    {
        if (isset($request->noti_id)) {
            DB::table('notifications')->where('id', $request->noti_id)->update(['read_at' => Carbon::now()]);
        }
        $limit = $request->limit ?? 10;
        $request->page = $request->page1 > 0 ? $request->page1 : $request->page;
        $this->v['requests'] = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->selectRaw('requests.code,requests.id,requests.created_at,requests.status,categories.name,products.name as product_name,users.name as user_name')
            ->where('requests.vstore_id', Auth::id())
            ->orderBy('requests.id', 'desc')
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
        $message = $request->status == 2 ? $userLogin->name . ' đã đồng yêu cầu niêm yết sản phẩm đến bạn và gửi yêu cầu tời quản trị viên' : $userLogin->name . ' đã từ chối yêu cầu niêm yết sản phẩm của bạn';
        $data = [
            'title' => 'Bạn vừa có 1 thông báo mới',
            'avatar' => $userLogin->avatar ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
            'message' => $message,
            'created_at' => Carbon::now()->format('h:i A d/m/Y'),
            'href' => route('screens.manufacture.product.request', ['condition' => 'sku_id', 'key_search' => $currentRequest->sku_id])
        ];
        $user->notify(new AppNotification($data));

        if ($request->status == 2) {
            $admin = User::where('role_id', 1)->first();
            $user = User::find($admin->id); // id của user mình đã đăng kí ở trên, user này sẻ nhận được thông báo
            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => $userLogin->avatar ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                'message' => $currentRequest->NCC->name . ' đã gửi yêu cầu niêm yết sản phẩm đến bạn',
                'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => route('screens.admin.product.index', ['condition' => 'sku_id', 'key_search' => $currentRequest->sku_id])
            ];

            $user->notify(new AppNotification($data));
        }

        return redirect()->back()->with('success', 'Thay đổi trạng thái yêu cầu thành công');
    }

}
