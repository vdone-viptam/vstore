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
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thời trang nam',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Sắc đẹp',
                'created_at'=>Carbon::now(),
            ], [
                    'name'=>'Sức khỏe',
                    'created_at'=>Carbon::now(),
            ], [
                    'name'=>'Phụ kiện thời trang',
                    'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thiết bị điện gia dụng',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Giày dép nam',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Điện thoại & phụ kiện',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Du lịch & Hành lý',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Túi ví nữ',
                'created_at'=>Carbon::now(),
            ], [
                'name'=>'Túi ví nam',
                    'created_at'=>Carbon::now(),
            ],[
                'name'=>'Đồng hồ',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thiết bị âm thanh',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thực phầm vào đồ uống',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Chăm sóc thú cưng',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Mẹ & Bé',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thời trang trẻ em & trẻ sơ sinh',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Gaming & Console',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Cameras & Flycam',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Nhà cửa & Đời sống',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Thể Thao & Dã Ngoại',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Văn Phòng Phẩm',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Ô tô',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Mô tô, xe máy',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Sách',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Máy tính & Laptop',
                'created_at'=>Carbon::now(),
            ],[
                'name'=>'Bất động sản',
                'created_at'=>Carbon::now(),
            ],

            ]
        );
    }
}
