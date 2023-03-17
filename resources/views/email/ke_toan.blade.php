<p style="margin-bottom: 16px">Hệ thống vừa có 1 đơn đăng ký mới</p>
<table border="1">
    <tr>
        <th>STT</th>
        <th>
            Tên
        </th>
        <th>
            Email
        </th>
        <th>ID người đại diện</th>
        <th>Tên công ty</th>
        <th>Số điện thoại</th>
        <th>Mã số thuế</th>
        <th>Địa chỉ</th>
        <th>Ngày đăng ký</th>
        <th>Quyền</th>
        <th>Mã giới thiệu</th>
    </tr>
    <tr>
        <td>1</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->id_vdone}}</td>
        <td>{{$user->company_name}}</td>
        <td>{{$user->phone_number}}</td>
        <td>{{$user->tax_code}}</td>
        <td>{{$user->address}}</td>
        <td>{{\Illuminate\Support\Carbon::parse($user->created_at)->format('d/m/Y h:i A')}}</td>
        <td>
            @if($user->role_id == 2)
                Nhà cung cấp
            @elseif($user->role_id == 1)
                Admin
            @elseif($user->role_id == 4)
                Kho
            @else
                Nhà phân phối
            @endif
        </td>
        <td>
            {{strlen($user->referral_code) > 0 ? $user->referral_code : 'Không có'}}
        </td>
    </tr>
</table>

