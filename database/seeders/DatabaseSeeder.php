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
        // \App\Models\User::factory(10)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@gmail.com',
//             'password'=>Hash::make('123456')
//         ]);
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'system@vdone.vn';
        $user->password = Hash::make('123456');
        $user->id_vdone = '123';
        $user->company_name = 'Thương mại điện tử V-store';
        $user->phone_number = '0325500080';
        $user->tax_code = '10000';
        $user->address = 'Việt Nam';
        $user->role_id = 1;
        $user->account_code = 'ad-tmdt1';
        $user->save();


        DB::table('categories')->insert([[
                'name' => 'Thời trang nữ',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thời trang nam',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Sắc đẹp',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ], [
                    'name'=>'Sức khỏe',
                    'img'=>'image/category/',
                    'created_at'=>Carbon::now(),
            ], [
                    'name'=>'Phụ kiện thời trang',
                'img'=>'image/category/',
                    'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thiết bị điện gia dụng',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Giày dép nam',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Điện thoại & phụ kiện',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Du lịch & Hành lý',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Túi ví nữ',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ], [
                'name'=>'Túi ví nam',
                'img'=>'image/category/',
                    'created_at'=>Carbon::now(),
            ],[
                'name'=>'Đồng hồ',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thiết bị âm thanh',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thực phầm và đồ uống',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Chăm sóc thú cưng',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Mẹ & Bé',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thời trang trẻ em & trẻ sơ sinh',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Gaming & Console',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Cameras & Flycam',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Nhà cửa & Đời sống',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thể Thao & Dã Ngoại',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Văn Phòng Phẩm',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Ô tô',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Mô tô, xe máy',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Sách',
                'img'=>'image/category/',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Máy tính & Laptop',
                'img'=>'image/category/may_tinh_laptop.png',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Bất động sản',
                'img'=>'image/category/nha_cua_doi_song.png',
                'created_at'=>Carbon::now(),
            ],

            ]
        );
    }
}
