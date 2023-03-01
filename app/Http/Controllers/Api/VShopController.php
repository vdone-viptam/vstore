<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BuyMoreDiscount;
use App\Models\Product;
use App\Models\User;
use App\Models\Vshop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group Vshop
 *
 * Danh sách api liên quan V-shop
 */
class  VShopController extends Controller
{

    public function index(){
        $vshop = Vshop::all();
        return response()->json([
            'status_code' => 200,
            'message' => 'Lấy thông tin thành công',
            'data'=>$vshop
        ]);
    }
    public function getProductByIdPdone(Request $request)
    {
        $limit = $request->limit ?? 10;
        $pdone = Vshop::select('*')->join('products', 'vshop.id_product', '=', 'products.id')->where('id_pdone', $request->id_pdone)->orderBy('vshop.id', 'desc')->paginate($limit);

        return response()->json($pdone);
    }

    public function getDiscountByTotalProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
            'total' => 'required|numeric',

        ], [
            'publish_id.required' => 'Mã sản phẩm là bắt buộc',
            'total.required' => 'Số lượng sản phẩm nhập là bắt buộc',
            'total.numeric' => 'Số lượng sản phẩm phải là số'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }

        $discount = DB::table('buy_more_discount')->select('discount')
                ->where('start', '<=', $request->total)
                ->where('end', '>', $request->total)
                ->where('product_id', $request->id)
                ->first()->discount ?? 0;
//        return $discount;
        if ($discount == 0) {
            $discount = DB::table('buy_more_discount')->select('discount')
                ->where('end', 0)
                ->where('product_id', $request->id)
                ->first()->discount;
        }
        return response()->json([
            'status_code' => 200,
            'discount' => $discount,
        ]);

    }

    public function storeAddressReceive(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pdone' => 'required|max:255',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }

        try {
            $address = $request->address;
            $result = app('geocoder')->geocode($address)->get();
            $coordinates = $result[0]->getCoordinates();
            $lat = $coordinates->getLatitude();
            $long = $coordinates->getLongitude();
            DB::table('vshop')->insert([
                'id_pdone' => $request->id_pdone,
                'name' => $request->name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'lat' => $lat,
                'long' => $long,
                'created_at' => Carbon::now()
            ]);

            return response()->json([
                'status_code' => 201,
                'message' => 'Thêm mới địa chỉ thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function editAddressReceive(Request $request, $id)
    {

        try {
            $address = DB::table('vshop')->select('name', 'address', 'address', 'phone_number', 'id')->where('id_pdone', $id)->first();
            return response()->json([
                'status_code' => 200,
                'data' => $address,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessage(),
            ]);
        }

    }

    /**
     * Lưu mới mã giảm giá
     *
     * API này sẽ lưu mới mã giảm giá
     *
     * @param Request $request
     * @bodyParam id_pdone Mã p done required
     * @bodyParam product_id Mã sản phẩm required exits:products
     * @bodyParam start_date Ngày bắt đầu required date_format:Y/m/d after:Today
     * @bodyParam end_date Ngày kết thúc required date_format:Y/m/d after:start_date
     * @urlParam discount Phần trăm giảm giá required max:discount_vShop
     * @return \Illuminate\Http\JsonResponse
     */

    public function createDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pdone' => 'required',
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date_format:Y/m/d|after:' . Carbon::now(),
            'end_date' => 'required|date_format:Y/m/d|after:start_date',
            "discount" => 'required|max:100'

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }
        $discount = Product::select('discount_vShop')->where('id', $request->product_id)->where('status', 2)->first()->discount_vShop ?? 0;

        if (DB::table('discounts')->where('user_id', $request->id_pdone)->where('product_id', $request->product_id)->count() > 0) {
            return response()->json([
                'status_code' => 401,
                'error' => 'Mã giảm giá đã tồn tại',
            ]);
        }
        if ($discount == 0) {
            return response()->json([
                'status_code' => 401,
                'error' => 'Sản phẩm chưa niêm yết',
            ]);
        } elseif ($request->discount > $discount) {
            return response()->json([
                'status_code' => 401,
                'error' => 'Phầm trăm giảm giá nhỏ hơn ' . $discount,
            ]);
        } else {
            DB::table('discounts')->insert([
                'product_id' => $request->product_id,
                'discount' => $request->discount,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'type' => 3,
                'user_id' => $request->id_pdone
            ]);
            return response()->json([
                'status_code' => 201,
                'message' => 'Tạo mã giảm giá thành công'
            ]);
        }


    }

    public function updateAddressReceive(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone_number' => 'required|max:255',

        ], []);
        if ($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'error' => $validator->errors(),
            ]);
        }
        try {
            $data = [
                'id_pdone' => $id,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'updated_at' => Carbon::now()
            ];
            if (DB::table('vshop')->where('address', $request->address)->where('id_pdone', $id)->count() == 0) {
                $data['address'] = $request->address;
                $address = $request->address;
                $result = app('geocoder')->geocode($address)->get();
                $coordinates = $result[0]->getCoordinates();
                $lat = $coordinates->getLatitude();
                $long = $coordinates->getLongitude();
                $data['lat'] = $lat;
                $data['long'] = $long;
            }

            $address = DB::table('vshop')->where('id_pdone', $id)->update($data);
            return response()->json([
                'status_code' => 201,
                'data' => 'Cập nhật địa chỉ thành công',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 400,
                'message' => $e->getMessage(),
            ]);
        }
    }

}
