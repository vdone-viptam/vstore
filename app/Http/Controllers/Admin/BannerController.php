<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->v = [];
    }

    public function index()
    {
        $this->v['banners'] = Banner::select('id', 'name', 'img')->orderBy('id', 'desc')->paginate(10);


        return view('screens.admin.banner.index', $this->v);
    }

    public function create()
    {
        return view('screens.admin.banner.create', $this->v);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
            'img' => 'required|image',
        ], [
            'name.required' => 'Tên banner bắt buộc nhập',
            'name.unique' => 'Tên banner đã tồn tại',
            'img.required' => 'Ảnh banner bắt buộc nhập',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }

        DB::beginTransaction();
        try {
            $banner = new Banner();
            $banner->name = trim($request->name);
            $file = $request->file('img');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('image/banners'), $filename);
            $banner->img = 'image/banners/' . $filename;
            $banner->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');

        }

        return redirect()->back()->with('success', 'Thêm mới banner thành công');
    }

    public function edit(Request $request, $id)
    {
        $this->v['banner'] = Banner::select('id', 'name', 'img')->where('id', $id)->first();
        return view('screens.admin.banner.edit', $this->v);
    }


    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
        ], [
            'name.required' => 'Tên banner bắt buộc nhập',
            'name.unique' => 'Tên banner đã tồn tại',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
        }
        DB::beginTransaction();
        try {
            $banner = Banner::find($id);
            $banner->name = trim($request->name);
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('image/banners'), $filename);
                $banner->img = 'image/banners/' . $filename;
            }
            $banner->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');

        }

        return redirect()->back()->with('success', 'Cập nhật banner thành công');
    }
}
