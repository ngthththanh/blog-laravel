<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $addresses = [
            'Hà Nội', 'Hải Phòng', 'Hải Dương', 'Hưng Yên', 'Hòa Bình', 'Lào Cai',
            'Lạng Sơn', 'Quảng Ninh', 'Thái Bình', 'Vĩnh Phúc', 'Bắc Giang', 'Bắc Kạn',
            'Bắc Ninh', 'Cao Bằng', 'Đắk Lắk', 'Đắk Nông', 'Điện Biên', 'Gia Lai',
            'Hà Giang', 'Hà Nam', 'Hà Tĩnh', 'Hòa Bình', 'Kon Tum', 'Lai Châu',
            'Nam Định', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ', 'Quảng Bình', 'Quảng Nam',
            'Quảng Ngãi', 'Quảng Trị', 'Sơn La', 'Tây Ninh', 'Thái Nguyên', 'Thanh Hóa',
            'Thừa Thiên Huế', 'Tiền Giang', 'Trà Vinh', 'Tuyên Quang', 'Vĩnh Long',
            'Vĩnh Phúc', 'Yên Bái', 'Bình Định', 'Bình Dương', 'Bình Phước', 'Bình Thuận',
            'Cần Thơ', 'Cà Mau', 'Hậu Giang', 'Hồ Chí Minh', 'Hưng Yên', 'Long An',
            'Sóc Trăng', 'Tây Ninh', 'Tiền Giang', 'Trà Vinh', 'Vĩnh Long', 'Vĩnh Phúc'
        ];

        foreach ($addresses as $address) {
            DB::table('addresses')->insert([
                'name' => $address,
            ]);
        }
    }
}