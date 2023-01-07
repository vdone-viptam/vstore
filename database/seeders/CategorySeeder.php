<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Thời trang nữ',
            'created_at'=>Carbon::now(),
        ],

        );
        DB::table('categories')->insert([
            'name' => 'Thời trang nam',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Sắc đẹp',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Sức khỏe',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Phụ kiện thời trang',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Thiết bị điện gia dụng',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Giày dép nam',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Điện thoại & phụ kiện',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Du lịch & Hành lý',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Túi ví nữ',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Giày dép nữ',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Túi ví nam',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Đồng hồ',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Thiết bị âm thanh',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Thực phầm vào đồ uống',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Chăm sóc thú cưng',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Mẹ & Bé',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Thời trang trẻ em & trẻ sơ sinh',
            'created_at'=>Carbon::now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Gaming & Console',
            'created_at'=>Carbon::now(),
        ]);

    }
}
