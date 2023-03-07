<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //

    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $limit = $request->limit ?? 10;
        $this->v['categories'] = Category::select('id', 'name', 'img');
        if (isset($request->keyword)) {
            $this->v['categories'] = $this->v['categories']->orwhere('name', 'like', '%' . $request->keyword . '%');
        }
        $this->v['params'] = $request->all();
        $this->v['categories'] = $this->v['categories']->paginate($limit);
        return view('screens.admin.category.index', $this->v);
    }

    public function create()
    {
        $this->v['categories'] = Category::select('id', 'name')->orderBy('id', 'desc')->get();
        return view('screens.admin.category.create', $this->v);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
            'img' => 'required|image',
            'parent_id' => 'required',
        ], [
            'name.required' => 'Tên danh mục bắt buộc nhập',
            'name.unique' => 'Tên danh muc đã tồn tại',
            'img.required' => 'Ảnh danh mục bắt buộc nhập',
            'img.image' => 'Ảnh danh mục không đúng định dạng',
            'parent_id' => 'Danh mục cha bắt buộc chọn'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->name = trim($request->name);
            $category->slug = Str::slug($request->name);
            $category->parent_id = $request->parent_id;
            $file = $request->file('img');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('image/category'), $filename);
            $category->img = 'image/category/' . $filename;
            $category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');

        }

        return redirect()->back()->with('success', 'Thêm mới danh mục sản phẩm thành công');
    }

    public function edit($id)
    {
        $this->v['categories'] = Category::select('id', 'name')->orderBy('id', 'desc')->get();
        $this->v['currentCategory'] = Category::find($id);
        return view('screens.admin.category.edit', $this->v);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'parent_id' => 'required',
        ], [
            'name.required' => 'Tên danh mục bắt buộc nhập',
            'img.required' => 'Ảnh danh mục bắt buộc nhập',
            'parent_id' => 'Danh mục cha bắt buộc chọn'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            $category->name = trim($request->name);
            $category->slug = Str::slug($request->name);
            $category->parent_id = $request->parent_id;
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('image/category'), $filename);
                $category->img = 'image/category/' . $filename;
            }
            $category->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');

        }
        return redirect()->back()->with('success', 'Cập nhật danh mục sản phẩm thành công');

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::destroy($id);
            DB::commit();
            return redirect()->back()->with('success', 'Xóa danh mục thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');
        }

    }
}
