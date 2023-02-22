<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vshop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class  VShopController extends Controller
{


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

    public function editAddressReceive(Request $request)
    {

        try {
            $address = DB::table('vshop')->select('name', 'address', 'address', 'phone_number', 'id')->where('id_pdone', $request->id_pdone)->first();
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

    public function updateAddressReceive(Request $request)
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
            $data = [
                'id_pdone' => $request->id_pdone,
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                'updated_at' => Carbon::now()
            ];
            if (DB::table('vshop')->where('address', $request->address)->where('id_pdone', $request->id_pdone)->count() > 0) {
                $data['address'] = $request->address;
                $address = $request->address;
                $result = app('geocoder')->geocode($address)->get();
                $coordinates = $result[0]->getCoordinates();
                $lat = $coordinates->getLatitude();
                $long = $coordinates->getLongitude();
                $data['lat'] = $lat;
                $data['long'] = $long;
            }
c

            $address = DB::table('vshop')->where('id_pdone', $request->id_pdone)->update($data);
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
