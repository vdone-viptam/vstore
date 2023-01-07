<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Enterprise;
use App\Models\Origin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Parser\Inline\BangParser;

class ProductController extends Controller
{
    //

    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {

        return view('screens.product.index', $this->v);
    }

    public function create(Request $request, $type = null)
    {
        $this->v['type'] = $type ?? 1;
        if ((int)$this->v['type'] === 1) {
            $this->v['brands'] = Brand::select('id', 'name')->orderBy('id', 'desc')->get();
            $this->v['origins'] = Origin::select('id', 'name')->orderBy('id', 'desc')->get();
            $this->v['categories'] = Category::select('id', 'name')->orderBY('id', 'desc')->get();
            return view('screens.product.create.info', $this->v);
        }
        if ((int)$this->v['type'] === 2) {
//            $this->v['brands'] = Brand::select('id', 'name')->orderBy('id', 'desc')->get();
//            $this->v['origins'] = Origin::select('id', 'name')->orderBy('id', 'desc')->get();
//            $this->v['categories'] = Category::select('id', 'name')->orderBY('id', 'desc')->get();
            $this->v['product_id'] = $request->product_id;
            return view('screens.product.create.detail', $this->v);
        }
        if ((int)$this->v['type'] === 3) {
//            $this->v['brands'] = Brand::select('id', 'name')->orderBy('id', 'desc')->get();
//            $this->v['origins'] = Origin::select('id', 'name')->orderBy('id', 'desc')->get();
//            $this->v['categories'] = Category::select('id', 'name')->orderBY('id', 'desc')->get();
            $this->v['product_id'] = $request->product_id;
            $this->v['enterprises'] = Enterprise::select('id', 'name')->orderBy('id', 'desc')->get();
            return view('screens.product.create.buy', $this->v);
        }
    }

    public function store(Request $request, $type = null)
    {
        if ((int)$type === 1) {
            $product = new Product();
            $product->name = $request->name;
            $product->cate_id = $request->cate_id;
            $product->price = $request->price;
            $product->cost_price = $request->cost_price;
            $product->barcode = $request->barcode;
            $product->sku = $request->sku;
            $product->trademark_id = $request->trademark_id;
            $product->origin_id = $request->origin_id;
            $product->status = $request->status ? 1 : 0;

            $product->save();

            return redirect()->route('screens.product.create', ['type' => 2, 'product_id' => $product->id]);
        } else if ((int)$type === 2) {
            $product = Product::find($request->product_id);
            $product->desc = $request->desc;
            $images = [];
            foreach (json_decode($request->photo_gallery) as $img) {
                $images[] = $this->saveImgBase64($img, 'products');
            }
            $product->photo_gallery = json_encode($images);

            $product->save();

            return redirect()->route('screens.product.create', ['type' => 3, 'product_id' => $product->id]);
        } else {
            return redirect()->back();
        }
    }


    protected function saveImgBase64($param, $folder)
    {
        list($extension, $content) = explode(';', $param);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $storage = Storage::disk('public');

        $checkDirectory = $storage->exists($folder);

        if (!$checkDirectory) {
            $storage->makeDirectory($folder);
        }

        $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');

        return $fileName;
    }
}
