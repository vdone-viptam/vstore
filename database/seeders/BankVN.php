<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankVN extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            [
                'name' => 'TECHCOMBANK',
                'image' => 'https://d1kndcit1zrj97.cloudfront.net/uploads/Logo_1_1_9f0486c0f5.png?w=1080&q=75',
                'full_name' => 'Ngân hàng Thương mại cổ phần Kỹ Thương Việt Nam'
            ],
            [
                'name' => 'BIDV',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Logo_BIDV.svg/512px-Logo_BIDV.svg.png?20220815121139',
                'full_name' => 'Bank for Investment and Development of Vietnam'
            ],
            [
                'name' => 'Sacombank',
                'image' => 'https://www.sacombank.com.vn/Style%20Library/2018/images/Sacombank-Logo.png',
                'full_name' => 'Ngân hàng thương mại cổ phần Sài Gòn Thương Tín'
            ],
            [
                'name' => 'Vietcombank',
                'image' => 'https://portal.vietcombank.com.vn/Resources/v3/img/logo.png',
                'full_name' => 'Ngân hàng thương mại cổ phần Ngoại thương Việt Nam'
            ],
            [
                'name' => 'VietinBank',
                'image' => 'https://www.vietinbank.vn/vtbresource/web/export/system/modules/com.vietinbank.cardtemplate/resources/img/logo.png?v=02262018',
                'full_name' => 'VietinBank'
            ],
            [
                'name' => 'Agribank',
                'image' => 'https://upload.wikimedia.org/wikipedia/vi/thumb/3/3d/Argibank_logo.svg/1920px-Argibank_logo.svg.png',
                'full_name' => 'Vietnam Bank for Agriculture and Rural Development'
            ],
            [
                'name' => 'VNCB',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/02/Logo-CBBank.png',
                'full_name' => 'Construction Bank'
            ],
            [
                'name' => 'OceanBank',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/f/fd/Logooceanbank.png',
                'full_name' => 'Ocean Bank'
            ],
            [
                'name' => 'GPBank',
                'image' => 'https://cdn.haitrieu.com/wp-content/uploads/2022/02/Logo-GPBank-Sl.png',
                'full_name' => 'Global Petro Bank'
            ],
            [
                'name' => 'VPBank',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4e/VPBank_logo.svg/1920px-VPBank_logo.svg.png',
                'full_name' => 'Vietnam Prosperity Bank'
            ],
            [
                'name' => 'MB',
                'image' => 'https://inkythuatso.com/uploads/images/2021/11/mb-bank-logo-inkythuatso-01-10-09-01-10.jpg',
                'full_name' => 'Military Commercial Joint Stock Bank'
            ],
            [
                'name' => 'ACB',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Asia_Commercial_Bank_logo.svg/1920px-Asia_Commercial_Bank_logo.svg.png',
                'full_name' => 'Asia Commercial Joint Stock Bank'
            ],
            [
                'name' => 'SHB',
                'image' => 'https://upload.wikimedia.org/wikipedia/vi/thumb/a/a7/Logo_Ng%C3%A2n_h%C3%A0ng_SHB.svg/1920px-Logo_Ng%C3%A2n_h%C3%A0ng_SHB.svg.png',
                'full_name' => 'Saigon - Hanoi Commercial Joint Stock Bank'
            ],
            [
                'name' => 'HDBank',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/6/6f/Logo_HDBank_with_slogan_in_Vietnamese%2C_logo_HDBank_ti%E1%BA%BFng_Vi%E1%BB%87t.jpg',
                'full_name' => 'Ho Chi Minh City Development Bank'
            ],
            [
                'name' => 'SCB',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/a/a0/Logo_ng%C3%A2n_h%C3%A0ng_Scb.png',
                'full_name' => 'Sai Gon Commercial Bank'
            ],
            [
                'name' => 'TPBank',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/Logo_TPBank.svg/1920px-Logo_TPBank.svg.png',
                'full_name' => 'Tien Phong Bank'
            ],
            [
                'name' => 'VIB',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/5/55/LOGO-VIB-Blue.png',
                'full_name' => 'Vietnam Maritime Joint - Stock Commercial Bank'
            ],
            [
                'name' => 'OCB',
                'image' => 'https://upload.wikimedia.org/wikipedia/vi/e/e5/Logo-Ngan_hang_Phuong_Dong.png',
                'full_name' => 'Orient Commercial Joint Stock Bank'
            ],
            [
                'name' => 'Eximbank',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Logoeib.jpg',
                'full_name' => 'Vietnam Export Import Commercial Joint Stock Bank'
            ],
            [
                'name' => 'LienVietPostBank',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/5/5b/Logo_Ng%C3%A2n_h%C3%A0ng_Th%C6%B0%C6%A1ng_m%E1%BA%A1i_C%E1%BB%95_ph%E1%BA%A7n_B%C6%B0u_%C4%91i%E1%BB%87n_ch%C3%ADnh_th%E1%BB%A9c_v%C3%A0_m%E1%BB%9Bi_nh%E1%BA%A5t.png',
                'full_name' => 'Lien Viet Postal Commercial Joint Stock Bank'
            ],
            [
                'name' => 'PVcombank',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/75/Logo_PVcombank.png/1920px-Logo_PVcombank.png',
                'full_name' => 'Vietnam Public Joint Stock Commercial Bank'
            ],
            [
                'name' => 'ABBANK',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Logoabbank.webp/332px-Logoabbank.webp.png',
                'full_name' => 'An Binh Bank'
            ],
            [
                'name' => 'NAB',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/Nam_A_Bank_Logo.jpg/1024px-Nam_A_Bank_Logo.jpg',
                'full_name' => 'Nam A Bank'
            ],
            [
                'name' => 'Saigonbank',
                'image' => 'https://vanhoadoisong.vn/wp-content/uploads/2022/10/saigonbank-la-ngan-hang-gi-thong-tin-chi-tiet-ve-saigonbank-02.jpg',
                'full_name' => 'Saigon Bank for Industry and Trade'
            ]
            
        ]);
    }
}
