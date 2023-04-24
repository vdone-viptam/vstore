<?php

namespace App\Http\Controllers\Manufacture;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        // dd(Auth::id());
        $this->v['field'] = $request->field ?? 'products.id';
        $this->v['type'] = $request->type ?? 'desc';
        $key_search = $request->key_search ?? '';
        $this->v['products'] = Product::join('users', 'products.vstore_id', '=', 'users.id')
            ->where('products.user_id', Auth::id())
            ->where('products.status', 2);
        // if ($key_search && strlen(($key_search) > 0)) {
        //     $this->v['products'] = $this->v['products']->where(function ($sub) use ($key_search) {
        //         $sub->where('products.name', 'like', '%' . $key_search . '%')
        //             ->orWhere('products.publish_id', 'like', '%' . $key_search . '%');
        //     });
        // }
        $this->v['products'] = $this->v['products']
            ->select('users.name as vstore_name','users.account_code','users.phone_number','vstore_id',
                    DB::raw('COUNT(products.id) as total_product'),
                )
            // ->selectSub('select count(id) from categories
            //             where id = products.category_id GROUP BY id',
            //             'total_category')
            ->groupBy('vstore_name','users.account_code','users.phone_number')
            ->orderBy($this->v['field'], $this->v['type'])
            ->paginate($request->limit ?? 10);

            foreach($this->v['products'] as $d){
                $countCategory = Product::where('products.user_id', Auth::id())
                                ->where('products.vstore_id',$d->vstore_id)
                                ->where('products.status', 2)
                                ->select(
                                    DB::raw('COUNT(products.category_id) as total_category'),
                                    'products.category_id'
                                )->groupBy('category_id')
                                ->get()->toArray();
                $d->total_category = count($countCategory);
            }
        $this->v['key_search'] = $request->key_search ?? '';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['params'] = $request->all();
        return view('screens.manufacture.partner.index', $this->v);
    }

    public function report()
    {
        return view('screens.manufacture.partner.report', []);

    }
    public function detail(Request $request)
    {
        $data = Product::where('products.user_id', Auth::id())
                ->where('products.vstore_id',$request->vstore_id)
                ->where('products.status', 2)
                ->select('discount','price')
                ->get();
        dd($data);

    }
}
