<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//         \App\Models\User::factory(10)->create();
//
//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@gmail.com',
//             'password'=>Hash::make('123456')
//         ]);
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'nhh.hoang@gmail.com.vn';
        $user->password = Hash::make('123456');
        $user->id_vdone = '123';
        $user->company_name = 'Thương mại điện tử V-Store';
        $user->phone_number = '0325500080';
        $user->tax_code = '10000';
        $user->address = 'Việt Nam';
        $user->role_id = 1;
        $user->account_code = '123123';
        $user->save();



//        DB::table('categories')->insert([[
//                'name' => 'Thời trang nữ',
//                'img' => 'image/category/thoi_trang_nu.png',
//                'created_at' => Carbon::now(),
//            ], [
//                'name' => 'Thời trang nam',
//                'img' => 'image/category/thoi_trang_nam.png',
//                'created_at' => Carbon::now(),
//            ], [
//                'name' => 'Sắc đẹp',
//                'img' => 'image/category/sac_dep.png',
//                'created_at' => Carbon::now(),
//            ], [
//                'name' => 'Sức khỏe',
//                'img' => 'image/category/suc_khoe.png',
//                'created_at' => Carbon::now(),
//            ], [
//                'name' => 'Phụ kiện thời trang',
//                'img' => 'image/category/phu_kien_thoi_trang.png',
//                'created_at' => Carbon::now(),
//            ], [
//                'name' => 'Thiết bị điện gia dụng',
//                'img' => 'image/category/thiet_bi_dien_gia_dung.png',
//                'created_at' => Carbon::now(),
//            ], [
//                'name' => 'Giày dép nam',
//                'img' => 'image/category/giay_dep_nam.png',
//                'created_at' => Carbon::now(),
//            ], [
//                'name' => 'Giày dép nữ',
//                'img' => 'image/category/giay_dep_nu.png',
//                'created_at' => Carbon::now(),
//            ],
//                [
//                    'name' => 'Điện thoại & phụ kiện',
//                    'img' => 'image/category/phu_kien_dien_thoai.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Du lịch & Hành lý',
//                    'img' => 'image/category/du_lich_hanh_ly.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Túi ví nữ',
//                    'img' => 'image/category/tui_vi_nu.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Túi ví nam',
//                    'img' => 'image/category/tui_vi_nam.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Đồng hồ',
//                    'img' => 'image/category/dong_ho.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Thiết bị âm thanh',
//                    'img' => 'image/category/thiet_bi_am_thanh.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Thực phầm và đồ uống',
//                    'img' => 'image/category/thuc_pham_do_uong.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Chăm sóc thú cưng',
//                    'img' => 'image/category/cham_soc_thu_cung.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Mẹ & Bé',
//                    'img' => 'image/category/me_be.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Thời trang trẻ em & trẻ sơ sinh',
//                    'img' => 'image/category/thoi_trang_tre_em.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Game & Console',
//                    'img' => 'image/category/game_console.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Cameras & Flycam',
//                    'img' => 'image/category/camera_flycam.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Nhà cửa & Đời sống',
//                    'img' => 'image/category/nha_cua_doi_song.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Thể Thao & Dã Ngoại',
//                    'img' => 'image/category/the_thao_da_ngoai.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Văn Phòng Phẩm',
//                    'img' => 'image/category/van_phong_pham.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Ô tô',
//                    'img' => 'image/category/o_to.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Mô tô, xe máy',
//                    'img' => 'image/category/moto_xe_may.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Sách',
//                    'img' => 'image/category/sach.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Máy tính & Laptop',
//                    'img' => 'image/category/may_tinh_laptop.png',
//                    'created_at' => Carbon::now(),
//                ], [
//                    'name' => 'Bất động sản',
//                    'img' => 'image/category/nha_cua_doi_song.png',
//                    'created_at' => Carbon::now(),
//                ],
//                [
//                    'name' => 'Sở thích & siêu tầm',
//                    'img' => 'image/category/so_thich_suu_tam.png',
//                    'created_at' => Carbon::now(),
//                ],
//
//            ]
//        );
    }
}
