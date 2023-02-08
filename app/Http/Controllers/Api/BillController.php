<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
     * @bodyParam  user_id mã user của người dùng mua hàng
     * @bodyParam name tên người dùng
     * @bodyParam phone_number số điện thoại
     * @bodyParam address địa chỉ
     * @bodyParam specific_address địa chỉ cụ thể
     * @bodyParam data dữ liệu sản phẩm publish_id:mã sản phẩm, vshop_id:mã vshop,quantity:số lượng sản phẩm [{"publish_id":"MSP17621675","vshop_id":"MVS123123","quantity":12},{"publish_id":"MSP17621675","vshop_id":"MVS123123","quantity":12}]
     * @return JsonResponse
     */
    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'name'=> 'required',
            'phone_number'=>'required',
            'address'=>'required',
            'specific_address'=>'required',
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
            $bill->user_id=$request->user_id;
            $bill->phone_number=$request->phone_number;
            $bill->address=$request->address;
            $bill->specific_address=$request->specific_address;
            $bill->save();
            $total = 0;
            foreach ($request->data as $value){
                $product = Product::where('publish_id',$value['publish_id'])->first();
                $bill_product = new BillProduct();
                $bill_product->publish_id =$value['publish_id'];
                $bill_product->vshop_id =$value['vshop_id'];
                $bill_product->quantity =$value['quantity'];
                $bill_product->user_id =$product->user_id;
                $bill_product->vshop_id =$request->user_id;
                $bill_product->price =$product->price;
                $bill_product->bill_id = $bill->id;
                $bill_product->product_id = $product->id;
                $bill_product->vstore_id= $product->vstore_id;

                $bill_product->save();
//                return $bill_product;
                $total += $bill_product->quantity =$value['quantity'] * $product->price ;
            }
            $bill->total = $total;
            $bill->save();
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
}
