<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\Vshop;
use App\Models\VshopProduct;
use App\Models\Warehouses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
/**
 * @group Bill
 *
 * Danh sách api liên quan hóa dơn
 */
class BillController extends Controller
{
    /**
     * Bill
     *
     * API dùng để lấy danh sách hóa đơn của 1 người dùng
     *
     * @param Request $request
     * @param  $id mã người dùng
     * @return JsonResponse
     */
    public function index($id){
        $bills = Bill::where('user_id',$id)->get();
        foreach ($bills as $value){
//            return $value->id;
            $bill_product = BillProduct::join('products','bill_product.product_id','=','products.id')->where('bill_product.bill_id',$value->id)
                ->select('products.name','products.publish_id','products.images','bill_product.price','bill_product.quantity')->get();
            $value->product = $bill_product;

        }
        return response()->json([
            'status_code' => 200,
            'message' => 'get list of successful invoices',
            'data'=>$bills,
        ]);
    }
    /**
     * Bill create
     *
     * API dùng để tạo hóa đơn
     *
     * @param Request $request
     * @param  $id mã sản phẩm
     * @bodyParam  id_pdone mã user của người dùng mua hàng
     * @bodyParam name tên người dùng
     * @bodyParam phone_number số điện thoại
     * @bodyParam address địa chỉ
     * @bodyParam data dữ liệu sản phẩm id:id sản phẩm, vshop_id: mã vshop,quantity:số lượng sản phẩm [{"id":"19","vshop_id":"MVS123123","quantity":12},{"id":"20","vshop_id":"MVS123123","quantity":12}]
     * @return JsonResponse
     */

    /*{
        "info":{
            "name" : "Ngô Văn Phong",
            "phone_number" : "0325500080",
             "total": 100000000,
              "address": "Tốt Động, Chương Mỹ, Hà Nội",
               "province": 1,
                "district_id": 2,
                }
      }
     *
     *
     *
     *
     */


    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'id_pdone' => 'required',
            'name'=> 'required',
            'phone_number'=>'required',
            'address'=>'required',
            'province'=>'required|numberic|min:1',
            'data'=>'required'
        ]);
        if($validator->fails())
        {
            return $validator->errors();
        }
        DB::beginTransaction();
        try {
            $bill = new Bill();
            $bill->name=$request->name;
            $bill->id_pdone=$request->id_pdone;
            $bill->phone_number=$request->phone_number;
            $bill->address=$request->address;
            $bill->save();
            $total = 0;
            foreach ($request->data as $value) {
                $product = Product::where('id', $value['id'])->where('status', 2)->first();
                if (!$product) {
                    return response()->json([
                        'status_code' => 400,
                        'data' => 'Không tìm thấy sản phẩm',
                    ], 400);
                }
            }
            DB::commit();

            return response()->json([
                'status_code' => 200,
                'message' => 'order creation successful',
            ]);
        }catch (\Exception $e) {
            DB::rollBack();
            return($e->getMessage());

        }
    }
    /**
     * chi tiết hóa đơn
     *
     * API này sẽ trả về chi tiết 1 hóa đơn
     *
     * @param Request $request
     * @param $id id của hóa đơn
     * @return JsonResponse
     */
    public function detail($id){
        $bill = Bill::where('id',$id)->first();
        if ($bill){
            $bill_product = BillProduct::join('products','bill_product.product_id','=','products.id')->where('bill_product.bill_id',$bill->id)
                ->select('products.name','products.publish_id','products.images','bill_product.price','bill_product.quantity')->get();
            $bill->product=$bill_product;
        }
        return response()->json([
            'status_code' => 200,
            'message' => 'successfully retrieved information',
            'data'=>$bill
        ]);
    }
    public function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }
}
