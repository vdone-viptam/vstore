<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
    }
    public function index(Request $request)
    {
        $this->v['field'] = $request->field ?? 'id';
        $this->v['type'] = $request->type ?? 'desc';
        $this->v['limit'] = $request->limit ?? 10;
        $this->v['key_search'] = trim($request->key_search) ?? '';
        $this->v['banks'] = Bank::query()->select('id', 'name', 'image', 'full_name');
        if (strlen($this->v['key_search']) > 0) {
            $this->v['banks'] = $this->v['banks']
            ->where('name', 'like', '%' . $this->v['key_search'] . '%')
            ->orwhere('full_name', 'like', '%' . $this->v['key_search'] . '%');
        }
        $this->v['banks'] = $this->v['banks']->orderBy($this->v['field'], $this->v['type'])->paginate($this->v['limit']);
        return view('screens.admin.bank.index', $this->v);
    }

    public function create()
    {
        $this->v['banks'] = Bank::select('id', 'name')->orderBy('id', 'desc')->get();
        return response()->json(['view' => view('screens.admin.bank.create', $this->v)->render()]);
    }

    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'name' => 'required|unique:banks|min:1|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'full_name' => 'required',
        ], [
            'name.required' => 'Tên ngân hàng bắt buộc nhập',
            'name.unique' => 'Tên ngân hàng đã tồn tại',
            'img.required' => 'Ảnh ngân hàng bắt buộc nhập',
            'img.image' => 'Ảnh ngân hàng không đúng định dạng',
            'img.mimes' => 'Ảnh ngân hàng không được hỗ trợ (jpeg,png,jpg,gif,svg)',
            'full_name.required' => 'Tên ngân hàng bắt buộc nhập',
            'full_name.unique' => 'Tên ngân hàng  đã tồn tại'
        ]);
        DB::beginTransaction();
        try {
            $bank = new Bank();
            $bank->name = $request->name;
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), ['folder' => 'bank'])->getSecurePath();
            $bank->image = $uploadedFileUrl;
            $bank->full_name = $request->full_name;
            $bank->save();
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới ngân hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');
        }
    }

    public function edit($id)
    {
        $this->v['banks'] = Bank::find($id);
        return response()->json(['view' => view('screens.admin.bank.edit', $this->v)->render()]);
    }
    public function update(Request $request, $id)
    {
        if (empty($request->image)) {
            Validator::make($request->all(), [
                'name' => 'required|unique:banks|min:1|max:255',
                'full_name' => 'required|min:1|max:255',
            ], [
                'name.required' => 'Tên ngân hàng bắt buộc nhập',
                'name.unique' => 'Tên ngân hàng đã tồn tại',
                'full_name.required' => 'Tên ngân hàng bắt buộc nhập',
                'full_name.unique' => 'Tên ngân hàng  đã tồn tại'
            ]);
            DB::beginTransaction();
            try {
                $bank = Bank::find($id);
                $bank->name = $request->name;
                $bank->full_name = $request->full_name;
                $bank->save();
                DB::commit();
                return redirect()->back()->with('success', 'Cập nhật danh mục sản phẩm thành công');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');
            }
        }
        Validator::make($request->all(), [
            'name' => 'required|unique:banks|min:1|max:255',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'full_name' => 'required|min:1|max:255',
        ], [
            'name.required' => 'Tên ngân hàng bắt buộc nhập',
            'name.unique' => 'Tên ngân hàng đã tồn tại',
            'img.required' => 'Ảnh ngân hàng bắt buộc nhập',
            'img.image' => 'Ảnh ngân hàng không đúng định dạng',
            'img.mimes' => 'Ảnh ngân hàng không được hỗ trợ (jpeg,png,jpg,gif,svg)',
            'full_name.required' => 'Tên ngân hàng bắt buộc nhập',
            'full_name.unique' => 'Tên ngân hàng  đã tồn tại'
        ]);
        DB::beginTransaction();
        try {
            $bank = Bank::find($id);
            $bank->name = $request->name;
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), ['folder' => 'bank'])->getSecurePath();
            $bank->image = $uploadedFileUrl;
            $bank->full_name = $request->full_name;
            $bank->save();
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật danh mục sản phẩm thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra.Vui lòng thử lại');
        }
    }
}
