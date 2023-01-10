<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        $user->email = 'contact@gmail.com';
        $user->password = Hash::make('123456');
        $user->id_vdone = '123';
        $user->company_name = 'Công ty Aneed';
        $user->phone_number = '0325500080';
        $user->tax_code = '10000';
        $user->address = 'Việt Nam';
        $user->role_id = 1;
        $user->save();

    }
}
