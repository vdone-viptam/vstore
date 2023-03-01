<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\BillProduct;
use App\Models\Product;
use App\Models\ProductWarehouses;
use App\Models\Vshop;
use App\Models\VshopProduct;
use App\Models\Warehouses;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    public function index($id)
    {
        $bills = Bill::where('user_id', $id)->get();
        foreach ($bills as $value) {
//            return $value->id;
            $bill_product = BillProduct::join('products', 'bill_product.product_id', '=', 'products.id')->where('bill_product.bill_id', $value->id)
                ->select('products.name', 'products.publish_id', 'products.images', 'bill_product.price', 'bill_product.quantity')->get();
            $value->product = $bill_product;

        }
        return response()->json([
            'status_code' => 200,
            'message' => 'get list of successful invoices',
            'data' => $bills,
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
     * @bodyParam  id_vshop mã user của vshop
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


    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_pdone' => 'required',
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'province' => 'required|numeric|min:1',
            'data' => 'required',
            'district' => 'required|numeric|min:1',

        ]);
        if ($validator->fails()) {
            return $validator->errors();
        }
        if (count($request->data) <= 0) {
            return response()->json([
                'status_code' => 400,
                'message' => 'data sản phẩm rỗng',
            ]);
        }
        DB::beginTransaction();
        try {
            $bill = new Bill();
            $bill->name = $request->name;
            $bill->id_pdone = $request->id_pdone;
            $bill->phone_number = $request->phone_number;
            $bill->address = $request->address;
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
//                return $value['id_vshop'];
                $checkVshopP = VshopProduct::where('product_id', $product->id)->where('id_pdone', $value['id_vshop'])->whereIn('status', [1, 2])->first();
                if (!$checkVshopP) {
                    return response()->json([
                        'status_code' => 400,
                        'data' => 'sản phẩm chưa được vshop nào lấy về',
                    ], 400);
                }

                $productWh = ProductWarehouses::where('product_id', $product->id)->where('status', 1)->groupBy('ware_id')->get();
//                return $productWh;
                if (count($productWh) == 0) {
                    return response()->json([
                        'status_code' => 400,
                        'data' => 'sẩn phẩm đã hết',

                    ], 400);
                }

                $ware_id = [];
                foreach ($productWh as $productp) {
                    $ware_id[] = $productp->ware_id;

                }

                $warehouses = Warehouses::whereIn('id', $ware_id)->get();
                $address = $bill->address;
                $result = app('geocoder')->geocode($address)->get();
                $coordinates = $result[0]->getCoordinates();
                $lat = $coordinates->getLatitude();
                $long = $coordinates->getLongitude();

                foreach ($warehouses as $val) {
                    $addressb = $val->address;
                    $resultb = app('geocoder')->geocode($addressb)->get();
                    $coordinatesb = $resultb[0]->getCoordinates();
                    $latb = $coordinatesb->getLatitude();
                    $longb = $coordinatesb->getLongitude();
                    $val->distance = $this->haversineGreatCircleDistance($lat, $long, $latb, $longb);

                }
//                return $warehouses;
//            $warehouses= $warehouses ->sortBy('distance','desc');
                $min = $warehouses[0];
                for ($i = 1; $i < count($warehouses); $i++) {
                    if ($min->distance > $warehouses[$i]->distance) {
                        $min = $warehouses[$i];
                    }
                }
                $bill_detail = BillDetail::where('bill_id', $bill->id)->where('ware_id', $min->id)->first();
                if (!$bill_detail) {
                    $bill_detail = new BillDetail();
                    $bill_detail->code = Str::random('11');
                    $bill_detail->bill_id = $bill->id;
                    $bill_detail->ware_id = $min->id;
                    $bill_detail->address = $request->address;
                    $bill_detail->district = $request->district;
                    $bill_detail->province = $request->province;
                    $bill_detail->save();

                }
                $sum =  DB::table('discounts')->selectRaw("SUM(discount) + (select IFNULL(SUM(discount),0)
                from discounts where type = 3 and product_id = " . $product->id . " and user_id = '".$value['id_vshop']."'
                )
                 as sum")
                    ->where('product_id', $product->id)
                    ->where('type', '!=', 3)
                    ->where('start_date','<=',Carbon::now())
                    ->where('end_date','>=',Carbon::now())
                    ->first()
                    ->sum;
//                return $sum;
                $bill_product = new BillProduct();
                $bill_product->code = $bill_detail->code;
                $bill_product->publish_id = $product->publish_id;
                $bill_product->vshop_id = $value['id_vshop'];
                $bill_product->quantity = $value['quantity'];
                $bill_product->price = $product->price - ($product->price /100 * $sum);
                $bill_product->bill_detail_id = $bill_detail->id;
                $bill_product->vstore_id = $product->vstore_id;
                $bill_product->product_id = $product->id;
                $bill_product->ware_id = $min->id;
                $bill_product->status = 1;
                $bill_product->save();

                $bill->total +=$bill_product->price;
                $bill_detail->total += $bill_product->price;
                $bill->save();
                $bill_detail->save();
            }
            return $bill_product ;
            DB::commit();

            return response()->json([
                'status_code' => 200,
                'message' => 'order creation successful',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return ($e->getMessage());

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
    public function detail($id)
    {
        $bill = Bill::where('id', $id)->first();
        if ($bill) {
            $bill_product = BillProduct::join('products', 'bill_product.product_id', '=', 'products.id')->where('bill_product.bill_id', $bill->id)
                ->select('products.name', 'products.publish_id', 'products.images', 'bill_product.price', 'bill_product.quantity')->get();
            $bill->product = $bill_product;
        }
        return response()->json([
            'status_code' => 200,
            'message' => 'successfully retrieved information',
            'data' => $bill
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
