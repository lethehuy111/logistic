<?php

namespace Database\Seeders;

use App\Globals\Constants;
use App\Models\ProvinceStock;
use App\Models\ShippingFee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        ProvinceStock::truncate();
        ShippingFee::truncate();

        $provinces = [
            [
                'name' => 'Hà Nội' ,  'point_x'=>  8,  'point_y' => 8 ,  'type' => Constants::TYPE_PROVINCE // 1
            ],
            [
                'name' =>  'Ninh Bình' , 'point_x'=> 5, 'point_y' => 6 , 'type' => Constants::TYPE_STOCK // 2
            ],
            [
                'name' =>  'Thanh Hóa' , 'point_x'=> 4,'point_y' => 4 , 'type' => Constants::TYPE_STOCK // 3
            ],
            [
                'Nghệ An' , 'point_x'=> 3, 'point_y' =>2 , 'type' => Constants::TYPE_PROVINCE // 4
            ],
            [
                'Hà Tĩnh' , 'point_x'=> 1, 'point_y' => 0 , 'type' => Constants::TYPE_PROVINCE // 5
            ],
        ];

        ProvinceStock::insert($provinces);
        $users = [
            [
               'name' => 'Nguyễn Văn Huy' , 'email' => 'huynv@gmail.com' , 'password' => Hash::make('123456'), 'email_verified_at' => now(), 'role' =>Constants::ROLE_CUSTOMER, 'status' => Constants::STATUS_ACTIVE , 'stock_id' => 1
            ],
            [
               'name' => 'Nguyến văn Hoàng' , 'email' => 'hoangnv@gmail.com' ,'password' => Hash::make('123456'),'email_verified_at' =>  now(), 'role' =>Constants::ROLE_CUSTOMER, 'status' => Constants::STATUS_ACTIVE, 'stock_id' => 2
            ],
            [
               'name' => 'Employee HN' , 'email' => 'ehn@gmail.com' ,'password' => Hash::make('123456'),'email_verified_at' =>  now(),'role' => Constants::ROLE_EMPLOYEE, 'status' => Constants::STATUS_ACTIVE, 'stock_id' => 1
            ],
            [
                'name' => 'Employee NB' , 'email' => 'enb@gmail.com' ,'password' => Hash::make('123456'),'email_verified_at' =>  now(),'role' => Constants::ROLE_EMPLOYEE, 'status' => Constants::STATUS_ACTIVE, 'stock_id' => 2
            ],
            [
                'name' => 'Employee TH' , 'email' => 'eth@gmail.com' ,'password' => Hash::make('123456'),'email_verified_at' =>  now(),'role' => Constants::ROLE_EMPLOYEE, 'status' => Constants::STATUS_ACTIVE, 'stock_id' => 3
            ],
            [
                'name' => 'Employee NA' , 'email' => 'ena@gmail.com' ,'password' => Hash::make('123456'),'email_verified_at' =>  now(),'role' => Constants::ROLE_EMPLOYEE, 'status' => Constants::STATUS_ACTIVE, 'stock_id' => 4
            ],
            [
               'name' => 'Employee HT' , 'email' => 'eht@gmail.com' ,'password' => Hash::make('123456'),'email_verified_at' =>  now(),'role' => Constants::ROLE_EMPLOYEE, 'status' => Constants::STATUS_ACTIVE, 'stock_id' => 5
            ],
            [
                'name' => 'Shipper HN' , 'email' => 'shn@gmail.com' , 'password' =>Hash::make('123456'), 'email_verified_at' => now(),'role' => Constants::ROLE_SHIPPER, 'status' => Constants::STATUS_ACTIVE , 'stock_id' => 1
            ],
            [
                'name' => 'Shipper NB' , 'email' => 'snb@gmail.com' , 'password' =>Hash::make('123456'), 'email_verified_at' => now(),'role' => Constants::ROLE_SHIPPER, 'status' => Constants::STATUS_ACTIVE , 'stock_id' => 2
            ],
            [
                'name' => 'Shipper TH' , 'email' => 'sth@gmail.com' , 'password' =>Hash::make('123456'), 'email_verified_at' => now(),'role' => Constants::ROLE_SHIPPER, 'status' => Constants::STATUS_ACTIVE , 'stock_id' => 3
            ],
            [
                'name' => 'Shipper NA' , 'email' => 'sna@gmail.com' , 'password' =>Hash::make('123456'), 'email_verified_at' => now(),'role' => Constants::ROLE_SHIPPER, 'status' => Constants::STATUS_ACTIVE , 'stock_id' => 4
            ],
            [
                'name' => 'Shipper HT' , 'email' => 'shy@gmail.com' , 'password' =>Hash::make('123456'), 'email_verified_at' => now(),'role' => Constants::ROLE_SHIPPER, 'status' => Constants::STATUS_ACTIVE , 'stock_id' => 5
            ],
        ];

        User::insert($users);

        $fees = [
            ['weight' =>  5 , 'price_point' => 6000],
            ['weight' =>  10 , 'price_point' => 10000],
            ['weight' =>  20 , 'price_point' => 18000],
            ['weight' =>  30 , 'price_point' => 30000],
            ['weight' =>  50 , 'price_point' => 60000]
        ];

        ShippingFee::insert($fees);

        Schema::enableForeignKeyConstraints();
    }
}
