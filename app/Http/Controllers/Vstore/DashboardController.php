<?php

namespace App\Http\Controllers\Vstore;

use App\Http\Controllers\Controller;
use App\Interfaces\Dashboard\DashboardRepositoryInterface;
use App\Models\Product;
use App\Models\Vshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private DashboardRepositoryInterface $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function index(Request $request)
    {
        $this->v['field'] = $request->field ?? 'products.id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = trim($request->key_search) ?? '';

        $limit = $request->limit ?? 10;

        $data = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->join('users', 'requests.user_id', '=', 'users.id')
            ->selectRaw('requests.code,requests.id,requests.created_at,categories.name as cate_name,products.name,users.name as user_name,products.price,requests.discount')
            ->where('requests.vstore_id', Auth::id())
            ->where('requests.status', 0);
        if (strlen($this->v['key_search'])) {
            $data = $data->where(function ($query) {
                $query->where('products.publish_id', $this->v['key_search'])
                    ->orWhere('products.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('categories.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('users.name', 'like', '%' . $this->v['key_search'] . '%')
                    ->orWhere('requests.code', $this->v['key_search']);
            });
        }
        $data = $data->orderBy($this->v['field'], $this->v['type'])
            ->paginate($this->v['limit']);

        $countRequestProductReview = DB::table('categories')->join('products', 'categories.id', '=', 'products.category_id')
            ->join('requests', 'products.id', '=', 'requests.product_id')
            ->where('requests.vstore_id', Auth::id())
            ->whereDate('requests.created_at', date('Y-m-d'))
            // ->where('requests.status', 0)
            ->count();

        $vshop = [];

        $dataRevenueToday = $this->dashboardRepository->revenueToday();
        $dataOrderToday = $this->dashboardRepository->orderToday();
        return view('screens.vstore.dashboard.index',
            [
                'data' => $data,
                'limit' => $limit,
                'field' => $this->v['field'],
                'type' => $this->v['type'],
                'key_search' => $this->v['key_search'],

                'vshop' => $vshop,

                'dataRevenueToday' => $dataRevenueToday,
                'dataOrderToday' => $dataOrderToday,
                'countRequestProductReview' => $countRequestProductReview,
            ]);

    }
}
