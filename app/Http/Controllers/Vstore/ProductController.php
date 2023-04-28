<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\BuyMoreDiscount;
use App\Models\Category;
use App\Models\Discount;
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
//        return $request->condition;
        $this->v['field'] = $request->field ?? 'products.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['products'] = Product::join('users', 'products.user_id', '=', 'users.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.status', 2)
            ->where('vstore_id', Auth::id())
            ->select(
                'products.publish_id',
                'products.name as name',
                'categories.name as cate_name',
                'products.price',
                'vat',
                'users.name as user_name',
                'products.discount as discount',
                'admin_confirm_date',
                'discount_vShop',
                'products.id');
        if (strlen($this->v['key_search'])) {
            $this->v['products'] = $this->v['products']->where(function ($query) {
                $query->where('products.publish_id', $this->v['key_search'])
                    ->orWhere('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $this->v['products'] = $this->v['products']->orderBy($this->v['field'], $this->v['type'])
            ->paginate($this->v['limit']);

        return view('screens.vstore.product.index', $this->v);
    }

    public function request(Request $request)
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
            ->selectRaw('requests.code,requests.id,requests.created_at,categories.name as cate_name,products.name,users.name as user_name,products.price,requests.discount')
            ->where('requests.vstore_id', Auth::id());
        if (strlen($this->v['key_search']) > 0) {
            $this->v['requests'] = $this->v['requests']->where(function ($query) {
                $query->where('requests.code', $this->v['key_search'])
                    ->orWhere('users.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $this->v['requests'] = $this->v['requests']->orderBy($this->v['field'], $this->v['type'])
            ->where('requests.status', 0)->paginate($this->v['limit']);

        return view('screens.vstore.product.request', $this->v);
    }

    public function requestAll(Request $request)
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
            ->selectRaw('requests.code,requests.id,requests.created_at,categories.name as cate_name,products.name,users.name as user_name,products.price,requests.discount,requests.status,products.vstore_confirm_date')
            ->where('requests.vstore_id', Auth::id());
        if (strlen($this->v['key_search']) > 0) {
            $this->v['requests'] = $this->v['requests']->where(function ($query) {
                $query->where('requests.code', $this->v['key_search'])
                    ->orWhere('users.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $this->v['requests'] = $this->v['requests']->orderBy($this->v['field'], $this->v['type'])->paginate($this->v['limit']);

        return view('screens.vstore.product.requestAll', $this->v);
    }

    public function detail(Request $request)
    {
        $type = $request->type ?? 1;
        if ($type == 1) {
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
            return response()->json(['view' => view('screens.vstore.product.detail', $this->v)->render()]);

        } else {
            $this->v['product'] = Category::select('publish_id', 'images',
                'products.name', 'brand', 'categories.name as cate_name', 'price', 'vat', 'short_content',
                'video', 'discount', 'admin_confirm_date', 'discount_vShop', 'users.name as user_name')
                ->join('products', 'categories.id', '=', 'products.category_id')
                ->join('users', 'products.user_id', '=', 'users.id')
                ->where('products.id', $request->id)
                ->first();
            return response()->json(['view' => view('screens.vstore.product.detail2', $this->v)->render()]);

        }
    }

    public function confirm($id, Request $request)
    {
        try {
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
            $product = Product::select('publish_id')->where('id', $currentRequest->product_id)->first();
            $data = [
                'title' => 'Bạn vừa có 1 thông báo mới',
                'avatar' => asset('image/users' . $userLogin->avatar) ?? 'https://phunugioi.com/wp-content/uploads/2022/03/Avatar-Tet-ngau.jpg',
                'message' => $message,
                'created_at' => Carbon::now()->format('h:i A d/m/Y'),
                'href' => route('screens.manufacture.product.request', ['key_search' => $product->publish_id])
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
                    'href' => route('screens.admin.product.index', ['key_search' => $product->publish_id])
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
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Thay đổi trạng thái yêu cầu thất bại');

        }
    }

    public function discount(Request $request)
    {
        $this->v['field'] = $request->field ?? 'discounts.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['discounts'] = DB::table('discounts')->select('discounts.id', 'discounts.discount', 'products.name', 'discounts.created_at', 'start_date', 'end_date', 'products.name', 'discounts.status')
            ->join('products', 'discounts.product_id', '=', 'products.id')
            ->where('discounts.user_id', Auth::id());
        if (strlen($this->v['key_search'])) {
            $this->v['discounts'] = $this->v['discounts']->where(function ($query) {
                $query->where('products.name', 'like', '%' . $this->v['key_search'] . '%');
            });
        }
        $this->v['discounts'] = $this->v['discounts']->orderBy($this->v['field'], $this->v['type'])->paginate($this->v['limit']);
        $this->onDiscount();
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
        return response()->json([
            'view' => view('screens.vstore.product.createDis', $this->v)->render()
        ]);
    }

    public function chooseProduct(Request $request)
    {
        $pro = DB::table('products')->select('price', 'discount', 'discount_vShop')
            ->where('id', $request->product_id)->first();
        if ($pro) {
            $pro->price = number_format($pro->price, 0, '.', '.') ?? 0;
            return $pro;
        } else {
            return null;
        }

    }

    public function storeDis(Request $request)
    {


        try {
            DB::table('discounts')->insert([
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'type' => 2,
                'user_id' => Auth::id(),
                'created_at' => Carbon::now()
            ]);

            return redirect()->route('screens.vstore.product.discount')->with('success', 'Thêm mới giảm giá thành công');
        } catch (\Exception $exception) {
            return redirect()->route('screens.vstore.product.discount')->with('error', 'Thêm mới giảm giá thất bại');

        }
    }

    public function editDis(Request $request, $id = null)
    {

        $product = DB::table('products')->select('name', 'id')->where('status', 2)->where('vstore_id', Auth::id())->get();
        $data = [];
        foreach ($product as $pr) {
            if (DB::table('discounts')->where('user_id', Auth::id())->where('product_id', $pr->id)->count() == 0) {
                $data[] = $pr;
            }
        }

        $this->v['products'] = $data;
        $this->v['discount'] = DB::table('discounts')->select('id', 'product_id', 'start_date', 'end_date', 'start_date', 'discount')->where('id', $id)->first();
        $this->v['product1'] = Product::select('discount', 'discount_vShop', 'price', 'name', 'id')->where('id', $this->v['discount']->product_id)->first();
        return response()->json([
            'view' => view('screens.vstore.product.editDis', $this->v)->render(),
            'id' => $this->v['discount']->id
        ]);

    }

    public function updateDis($id, Request $request)
    {


        try {
            DB::table('discounts')
                ->where('id', $id)
                ->update([
                    'product_id' => $request->product_id,
                    'discount' => $request->discount,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                ]);

            return redirect()->route('screens.vstore.product.discount')->with('success', 'Cập nhật giảm giá thành công');
        } catch (\Exception $exception) {
            return redirect()->route('screens.vstore.product.discount')->with('error', 'Cập nhật giảm giá thất bại');

        }
    }

    public function onDiscount()
    {
        $discount = Discount::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->where('discounts.user_id', Auth::id())
            ->get();
        if (count($discount) > 0) {
            foreach ($discount as $val) {
                $update_discount = Discount::find($val->id);
                if ($update_discount) {
                    $update_discount->status = 1;
                    $update_discount->save();
                }
            }
        }

    }
}
