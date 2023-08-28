<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert([
           [
               'name' => 'Khánh hòa',
               'email'=>'vstore.khanhhoa@gmail.com',
               'company_name' => 'Store Khánh hòa',
               'tax_code'=>1000000001,
               'code'=>'vnvst1000000001',
               'branch'=>2,
               'password'=>Hash::make('123456'),
                'address'=>'Khánh Hòa',
               'avatar'=>'Frame 1.png',
               'role_id'=>3
           ],
           [
               'name' => 'Bình dương',
               'email'=>'vstore.binhduong@gmail.com',
               'company_name' => 'Store Bình Dương',
               'tax_code'=>1000000002,
               'code'=>'vnvst1000000002',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Bình dương',
               'avatar'=>'bình dương.png',
               'role_id'=>3
           ],
           [
               'name' => 'Hà Nội',
               'email'=>'vstore.hanoi@gmail.com',
               'company_name' => 'Store Hà Nội',
               'tax_code'=>1000000003,
               'code'=>'vnvst1000000003',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Hà Nội',
               'avatar'=>'Frame 1 (1).png',
               'role_id'=>3
           ],
           [
               'name' => 'Phú Yên',
               'email'=>'vstore.phuyen@gmail.com',
               'company_name' => 'Store Phú Yên',
               'tax_code'=>1000000004,
               'code'=>'vnvst1000000004',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Phú Yên',
               'avatar'=>'Frame 1 (2).png',
               'role_id'=>3
           ],
           [
               'name' => 'Tây Ninh',
               'email'=>'vstore.tayninh@gmail.com',
               'company_name' => 'Store Tây Ninh',
               'tax_code'=>1000000005,
               'code'=>'vnvst1000000005',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Tây Ninh',
               'avatar'=>'Frame 1 (3).png',
               'role_id'=>3
           ],
           [
               'name' => 'Đồng Tháp',
               'email'=>'vstore.dongthap@gmail.com',
               'company_name' => 'Store Đồng Tháp',
               'tax_code'=>1000000006,
               'code'=>'vnvst1000000006',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Đồng Tháp',
               'avatar'=>'Frame 1 (4).png',
               'role_id'=>3
           ],
           [
               'name' => 'Thanh Hóa',
               'email'=>'vstore.thanhhoa@gmail.com',
               'company_name' => 'Store Thanh Hóa',
               'tax_code'=>1000000007,
               'code'=>'vnvst1000000007',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Thanh Hóa',
               'avatar'=>'Frame 1 (5).png',
               'role_id'=>3
           ],
           [
               'name' => 'Đăk Nông',
               'email'=>'vstore.daknong@gmail.com',
               'company_name' => 'Store Đăk Nông',
               'tax_code'=>1000000008,
               'code'=>'vnvst1000000008',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Đăk Nông',
               'avatar'=>'Frame 1 (6).png',
               'role_id'=>3
           ],
           [
               'name' => 'Sơn La',
               'email'=>'vstore.sonla@gmail.com',
               'company_name' => 'Store Sơn La',
               'tax_code'=>1000000009,
               'code'=>'vnvst1000000009',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Sơn La',
               'avatar'=>'Frame 1 (7).png',
               'role_id'=>3
           ],
           [
               'name' => 'Ninh Thuận',
               'email'=>'vstore.ninhthuan@gmail.com',
               'company_name' => 'Store Ninh Thuận',
               'tax_code'=>1000000010,
               'code'=>'vnvst1000000010',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Ninh Thuận',
               'avatar'=>'Frame 1 (8).png',
               'role_id'=>3
           ],
           [
               'name' => 'Gia Lai',
               'email'=>'vstore.gialai@gmail.com',
               'company_name' => 'Store Gia Lai',
               'tax_code'=>1000000011,
               'code'=>'vnvst1000000011',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Gia Lai',
               'avatar'=>'Frame 1 (9).png',
               'role_id'=>3
           ],
           [
               'name' => 'Bắc Giang',
               'email'=>'vstore.bacgiang@gmail.com',
               'company_name' => 'Store Bắc Giang',
               'tax_code'=>1000000012,
               'code'=>'vnvst1000000012',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Gia Lai',
               'avatar'=>'Frame 1 (10).png',
               'role_id'=>3
           ],
           [
               'name' => 'Bạc Liêu',
               'email'=>'vstore.baclieu@gmail.com',
               'company_name' => 'Store Bạc Liêu',
               'tax_code'=>1000000013,
               'code'=>'vnvst1000000013',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Bạc Liêu',
               'avatar'=>'Frame 1 (11).png',
               'role_id'=>3
           ],
           [
               'name' => 'Tiền Giang',
               'email'=>'vstore.tiengiang@gmail.com',
               'company_name' => 'Store Tiền Giang',
               'tax_code'=>1000000014,
               'code'=>'vnvst1000000014',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Bạc Liêu',
               'avatar'=>'Frame 1 (12).png',
               'role_id'=>3
           ],
           [
               'name' => 'Quảng Trị',
               'email'=>'vstore.quangtri@gmail.com',
               'company_name' => 'Store Tiền Giang',
               'tax_code'=>1000000015,
               'code'=>'vnvst1000000015',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Quảng Trị',
               'avatar'=>'Frame 1 (13).png',
               'role_id'=>3
           ],
           [
               'name' => 'Dak Lak',
               'email'=>'vstore.daklak@gmail.com',
               'company_name' => 'Store Dak Lak',
               'tax_code'=>1000000016,
               'code'=>'vnvst1000000016',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Dak Lak',
               'avatar'=>'Frame 1 (14).png',
               'role_id'=>3
           ],
           [
               'name' => 'Bình Thuận',
               'email'=>'vstore.binhthuan@gmail.com',
               'company_name' => 'Store Bình Thuận',
               'tax_code'=>1000000017,
               'code'=>'vnvst1000000017',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Dak Lak',
               'avatar'=>'Frame 1 (15).png',
               'role_id'=>3
           ],
           [
               'name' => 'Ninh Bình',
               'email'=>'vstore.ninhbinh@gmail.com',
               'company_name' => 'Store Ninh Bình',
               'tax_code'=>1000000018,
               'code'=>'vnvst1000000018',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Ninh Bình',
               'avatar'=>'Frame 1 (16).png',
               'role_id'=>3
           ],
           [
               'name' => 'Bến Tre',
               'email'=>'vstore.bentre@gmail.com',
               'company_name' => 'Store Bến Tre',
               'tax_code'=>1000000019,
               'code'=>'vnvst1000000019',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Bến Tre',
               'avatar'=>'Frame 1 (17).png',
               'role_id'=>3
           ],
           [
               'name' => 'Hậu Giang',
               'email'=>'vstore.haugiang@gmail.com',
               'company_name' => 'Store Hậu Giang',
               'tax_code'=>1000000020,
               'code'=>'vnvst1000000020',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Hậu Giang',
               'avatar'=>'Frame 1 (18).png',
               'role_id'=>3
           ],
           [
               'name' => 'Đà Nẵng',
               'email'=>'vstore.danang@gmail.com',
               'company_name' => 'Store Đà Nẵng',
               'tax_code'=>1000000021,
               'code'=>'vnvst1000000021',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Đà Nẵng',
               'avatar'=>'Frame 1 (19).png',
               'role_id'=>3
           ],
           [
               'name' => 'Yên Bái',
               'email'=>'vstore.yenbai@gmail.com',
               'company_name' => 'Store Yên Bái',
               'tax_code'=>1000000022,
               'code'=>'vnvst1000000022',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Yên Bái',
               'avatar'=>'Frame 1 (20).png',
               'role_id'=>3
           ],
           [
               'name' => 'Trà vinh',
               'email'=>'vstore.travinh@gmail.com',
               'company_name' => 'Store Trà Vinh',
               'tax_code'=>1000000023,
               'code'=>'vnvst1000000023',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Trà Vinh',
               'avatar'=>'Frame 1 (21).png',
               'role_id'=>3
           ],
           [
               'name' => 'Vĩnh Long',
               'email'=>'vstore.travinh@gmail.com',
               'company_name' => 'Store Vĩnh Long',
               'tax_code'=>1000000024,
               'code'=>'vnvst1000000024',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Vĩnh Long',
               'avatar'=>'Frame 1 (22).png',
               'role_id'=>3
           ],
           [
               'name' => 'Sóc Trăng',
               'email'=>'vstore.soctrang@gmail.com',
               'company_name' => 'Store Sóc Trăng',
               'tax_code'=>1000000025,
               'code'=>'vnvst1000000025',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Sóc Trăng',
               'avatar'=>'Frame 1 (42).png',
               'role_id'=>3
           ],

           [
               'name' => 'Hà Nam',
               'email'=>'vstore.hanam@gmail.com',
               'company_name' => 'Store Hà Nam',
               'tax_code'=>1000000026,
               'code'=>'vnvst1000000026',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Hà Nam',
               'avatar'=>'Frame 1 (24).png',
               'role_id'=>3
           ],
           [
               'name' => 'Vĩnh Phúc',
               'email'=>'vstore.vinhphuc@gmail.com',
               'company_name' => 'Store Vinh Phuc',
               'tax_code'=>1000000027,
               'code'=>'vnvst1000000027',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Vĩnh Phúc',
               'avatar'=>'Frame 1 (25).png',
               'role_id'=>3
           ],
           [
               'name' => 'Hồ Chí Minh',
               'email'=>'vstore.hcm@gmail.com',
               'company_name' => 'Store Hồ Chí Minh',
               'tax_code'=>1000000028,
               'code'=>'vnvst1000000028',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Hồ Chí Minh',
               'avatar'=>'Frame 1 (26).png',
               'role_id'=>3
           ],
           [
               'name' => 'Phú thọ',
               'email'=>'vstore.phutho@gmail.com',
               'company_name' => 'Store Phú thọ',
               'tax_code'=>1000000029,
               'code'=>'vnvst1000000029',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Phú thọ',
               'avatar'=>'Frame 1 (27).png',
               'role_id'=>3
           ],
           [
               'name' => 'Bắc Kạn',
               'email'=>'vstore.backan@gmail.com',
               'company_name' => 'Store Bắc Kạn',
               'tax_code'=>1000000030,
               'code'=>'vnvst1000000030',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Bắc Kạn',
               'avatar'=>'Frame 1 (28).png',
               'role_id'=>3
           ],

           [
               'name' => 'Cần Thơ',
               'email'=>'vstore.cantho@gmail.com',
               'company_name' => 'Store Cần thơ',
               'tax_code'=>1000000031,
               'code'=>'vnvst1000000032',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Cần thơ',
               'avatar'=>'Frame 1 (29).png',
               'role_id'=>3
           ],
           [
               'name' => 'Hà Tĩnh',
               'email'=>'vstore.hatinh@gmail.com',
               'company_name' => 'Store Hà Tĩnh',
               'tax_code'=>1000000033,
               'code'=>'vnvst1000000033',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Hà Tĩnh',
               'avatar'=>'Frame 1 (30).png',
               'role_id'=>3
           ],
           [
               'name' => 'Long An',
               'email'=>'vstore.longan@gmail.com',
               'company_name' => 'Store Hà Tĩnh',
               'tax_code'=>1000000034,
               'code'=>'vnvst1000000034',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Long An',
               'avatar'=>'Frame 1 (31).png',
               'role_id'=>3
           ],
           [
               'name' => 'Lạng Sơn',
               'email'=>'vstore.langson@gmail.com',
               'company_name' => 'Store Lạng Sơn',
               'tax_code'=>1000000035,
               'code'=>'vnvst1000000035',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Lạng Sơn',
               'avatar'=>'Frame 1 (32).png',
               'role_id'=>3
           ],
           [
               'name' => 'Kon Tum',
               'email'=>'vstore.kontum@gmail.com',
               'company_name' => 'Store Kon Tum',
               'tax_code'=>1000000036,
               'code'=>'vnvst1000000036',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Kon Tum',
               'avatar'=>'Frame 1 (33).png',
               'role_id'=>3
           ],
           [
               'name' => 'Nam Định',
               'email'=>'vstore.namdinh@gmail.com',
               'company_name' => 'Store Nam Định',
               'tax_code'=>10000000137,
               'code'=>'vnvst1000000037',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Nam Định',
               'avatar'=>'Frame 1 (34).png',
               'role_id'=>3
           ],
           [
               'name' => 'Lào Cai',
               'email'=>'vstore.laocai@gmail.com',
               'company_name' => 'Store Lào Cai',
               'tax_code'=>1000000038,
               'code'=>'vnvst1000000038',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Lào cai',
               'avatar'=>'Frame 1 (35).png',
               'role_id'=>3
           ],
           [
               'name' => 'An Giang',
               'email'=>'vstore.angiang@gmail.com',
               'company_name' => 'Store An Giang',
               'tax_code'=>1000000039,
               'code'=>'vnvst1000000039',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'An Giang',
               'avatar'=>'Frame 1 (36).png',
               'role_id'=>3
           ],
           [
               'name' => 'Nghệ An',
               'email'=>'vstore.nghean@gmail.com',
               'company_name' => 'Store Nghệ An',
               'tax_code'=>1000000040,
               'code'=>'vnvst1000000040',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Nghệ An',
               'avatar'=>'Frame 1 (37).png',
               'role_id'=>3
           ],
           [
               'name' => 'Bà Rịa - Vũng Tàu',
               'email'=>'vstore.bariavungtau@gmail.com',
               'company_name' => 'Store Bà Rịa - Vũng Tàu',
               'tax_code'=>10000000141,
               'code'=>'vnvst1000000041',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Bà Rịa - Vũng Tàu',
               'avatar'=>'Frame 1 (38).png',
               'role_id'=>3
           ],
           [
               'name' => 'Tuyên Quang',
               'email'=>'vstore.tuyenquang@gmail.com',
               'company_name' => 'Store Tuyên Quang',
               'tax_code'=>1000000042,
               'code'=>'vnvst1000000042',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Tuyên Quang',
               'avatar'=>'Frame 1 (39).png',
               'role_id'=>3
           ],
           [
               'name' => 'Quãng Ngãi',
               'email'=>'vstore.quangngai@gmail.com',
               'company_name' => 'Store Quãng Ngãi',
               'tax_code'=>1000000043,
               'code'=>'vnvst1000000043',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Quãng Ngãi',
               'avatar'=>'Frame 1 (40).png',
               'role_id'=>3
           ],
           [
               'name' => 'Hải Dương',
               'email'=>'vstore.haiduong@gmail.com',
               'company_name' => 'Store Hải Dương',
               'tax_code'=>1000000044,
               'code'=>'vnvst1000000044',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Hải Dương',
               'avatar'=>'Frame 1 (41).png',
               'role_id'=>3
           ],
           [
               'name' => 'Lai Châu',
               'email'=>'vstore.laichau@gmail.com',
               'company_name' => 'Store Lai châu',
               'tax_code'=>1000000045,
               'code'=>'vnvst100000045',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'lai châu',
               'avatar'=>'lai châu.png',
               'role_id'=>3
           ],
           [
               'name' => 'Huế',
               'email'=>'vstore.hue@gmail.com',
               'company_name' => 'Store Huế',
               'tax_code'=>1000000046,
               'code'=>'vnvst1000000046',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Huế',
               'avatar'=>'huế.png',
               'role_id'=>3
           ],
           [
               'name' => 'Khánh hòa',
               'email'=>'vstore.khánh hòa@gmail.com',
               'company_name' => 'Store khánh hòa',
               'tax_code'=>1000000047,
               'code'=>'vnvst1000000047',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'khánh hòa',
               'avatar'=>'Frame 1.png',
               'role_id'=>3
           ],
           [
               'name' => 'Điện Biên',
               'email'=>'vstore.dienbien@gmail.com',
               'company_name' => 'Store Điện Biên',
               'tax_code'=>1000000048,
               'code'=>'vnvst1000000048',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Điện Biên',
               'avatar'=>'Frame 1 (56).png',
               'role_id'=>3
           ],
           [
               'name' => 'Hưng yên',
               'email'=>'vstore.hungyen@gmail.com',
               'company_name' => 'Store Hưng yên',
               'tax_code'=>1000000049,
               'code'=>'vnvst1000000049',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Hưng yên',
               'avatar'=>'Frame 1 (55).png',
               'role_id'=>3
           ],
           [
               'name' => 'Hòa Bình',
               'email'=>'vstore.hoabinh@gmail.com',
               'company_name' => 'Store Hòa Bình',
               'tax_code'=>1000000050,
               'code'=>'vnvst1000000050',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Hòa Bình',
               'avatar'=>'Frame 1 (54).png',
               'role_id'=>3
           ],
           [
               'name' => 'Kiên Giang',
               'email'=>'vstore.kiengiang@gmail.com',
               'company_name' => 'Store Kiên Giang',
               'tax_code'=>1000000051,
               'code'=>'vnvst1000000051',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Kiên Giang',
               'avatar'=>'Frame 1 (53).png',
               'role_id'=>3
           ],
           [
               'name' => 'Lâm Đồng',
               'email'=>'vstore.lamdong@gmail.com',
               'company_name' => 'Store Lâm Đồng',
               'tax_code'=>1000000052,
               'code'=>'vnvst1000000052',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Lâm Đồng',
               'avatar'=>'Frame 1 (52).png',
               'role_id'=>3
           ],
           [
               'name' => 'Quảng Ninh',
               'email'=>'vstore.quangninh@gmail.com',
               'company_name' => 'Store Quảng Ninh',
               'tax_code'=>1000000053,
               'code'=>'vnvst1000000053',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Quảng Ninh',
               'avatar'=>'Frame 1 (51).png',
               'role_id'=>3
           ],
           [
               'name' => 'Hà Giang',
               'email'=>'vstore.hagiang@gmail.com',
               'company_name' => 'Store Hà Giang',
               'tax_code'=>1000000054,
               'code'=>'vnvst1000000054',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Hà Giang',
               'avatar'=>'Frame 1 (49).png',
               'role_id'=>3
           ],
           [
               'name' => 'Thái Nguyên',
               'email'=>'vstore.thainguyen@gmail.com',
               'company_name' => 'Store Thái Nguyên',
               'tax_code'=>1000000055,
               'code'=>'vnvst1000000055',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Thái Nguyên',
               'avatar'=>'Frame 1 (48).png',
               'role_id'=>3
           ],
           [
               'name' => 'Cao Bằng',
               'email'=>'vstore.caobang@gmail.com',
               'company_name' => 'Store Cao Bằng',
               'tax_code'=>1000000056,
               'code'=>'vnvst1000000056',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Cao Bằng',
               'avatar'=>'Frame 1 (47).png',
               'role_id'=>3
           ],
           [
               'name' => 'Đồng Nai',
               'email'=>'vstore.dongnai@gmail.com',
               'company_name' => 'Store Đồng Nai',
               'tax_code'=>1000000057,
               'code'=>'vnvst1000000057',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Đồng Nai',
               'avatar'=>'Frame 1 (46).png',
               'role_id'=>3
           ],
           [
               'name' => 'Thái Bình',
               'email'=>'vstore.thaibinh@gmail.com',
               'company_name' => 'Store Thái Bình',
               'tax_code'=>1000000058,
               'code'=>'vnvst1000000058',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Thái Bình',
               'avatar'=>'Frame 1 (45).png',
               'role_id'=>3
           ],
           [
               'name' => 'Cà Mau',
               'email'=>'vstore.camau@gmail.com',
               'company_name' => 'Store Cà Mau',
               'tax_code'=>1000000059,
               'code'=>'vnvst1000000059',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Cà Mau',
               'avatar'=>'Frame 1 (44).png',
               'role_id'=>3
           ],
           [
               'name' => 'Bình Phước',
               'email'=>'vstore.binhphuoc@gmail.com',
               'company_name' => 'Store Bình Phước',
               'tax_code'=>1000000060,
               'code'=>'vnvst1000000060',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Bình Phước',
               'avatar'=>'Frame 1 (43).png',
               'role_id'=>3
           ],
           [
               'name' => 'Quảng Bình',
               'email'=>'vstore.quangbinh@gmail.com',
               'company_name' => 'Store Quảng Bình',
               'tax_code'=>1000000061,
               'code'=>'vnvst1000000061',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Quảng Bình',
               'avatar'=>'Frame 1 (57).png',
               'role_id'=>3
           ],
           [
               'name' => 'Thừa Thiên Huế',
               'email'=>'vstore.quangbinh@gmail.com',
               'company_name' => 'Store Thừa Thiên Huế',
               'tax_code'=>1000000062,
               'code'=>'vnvst1000000062',
               'branch'=>2,
               'password'=>Hash::make('123456'),
               'address'=>'Thừa Thiên Huế',
               'avatar'=>'Frame 1 (58).png',
               'role_id'=>3
           ],


       ]);

        $user =User::where('tax_code','<=',1000000001)
        ->where('tax_code','>=',1000000062)->get();
        foreach ($user as $value){
            $user = new  User();
            $user->name= 'Ncc'+$value->name;
            $user->tax_code= $value->tax_code;
            $user->code= $value->code;
            $user->password=   Hash::make('123456');
            $user->address= $value->address;
            $user->role_id=2;
            $user->save();
    }
}
}