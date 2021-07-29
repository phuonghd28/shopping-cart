<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Bánh mì',
                'thumbnail' => 'https://www.thatlangon.com/wp-content/uploads/2020/05/cach-lam-banh-mi-viet-nam-hero.jpg',
                'price' => 15000,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'Sữa',
                'thumbnail' => 'https://cdn.tgdd.vn/2020/12/content/2-800x500-15.jpg',
                'price' => 10000,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'name' => 'Thịt',
                'thumbnail' => 'https://vinmec-prod.s3.amazonaws.com/images/20191112_133536_897440_thit-bo.max-800x800.png',
                'price' => 20000,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'name' => 'Mì gói',
                'thumbnail' => 'https://lamgiayphepnhanh.net/wp-content/uploads/2018/01/mi-an-lien-2.jpg',
                'price' => 5000,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'name' => 'Xúc xích',
                'thumbnail' => 'https://dochienxienque.com/wp-content/uploads/2021/02/Xuc-Xich-Duc-Loai-1-1.jpg',
                'price' => 75000,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'name' => 'Trứng',
                'thumbnail' => 'https://vinmec-prod.s3.amazonaws.com/images/20190615_102030_778121_tieu-duong-an-trung.max-1800x1800.jpg',
                'price' => 30000,
                'created_at' => Carbon::now()
            ], [
                'id' => 7,
                'name' => 'Thịt cá hồi',
                'thumbnail' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d9/Loch_Duart_Salmon%2C_Market_Hall%2C_Rockridge.jpg/300px-Loch_Duart_Salmon%2C_Market_Hall%2C_Rockridge.jpg',
                'price' => 100000,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 8,
                'name' => 'Nước tăng lực Monster',
                'thumbnail' => 'https://cdn.tgdd.vn/Products/Images/3226/142227/bhx/6-lon-nuoc-tang-luc-monster-energy-355ml-202103272049543278.jpg',
                'price' => 20000,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 9,
                'name' => 'Phô mai',
                'thumbnail' => 'https://cdn.tgdd.vn/Files/2020/05/13/1255328/phan-biet-9-loai-pho-mai-pho-bien-cach-su-dung-va-3.jpg',
                'price' => 25000,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 10,
                'name' => 'Rong biển',
                'thumbnail' => 'https://salt.tikicdn.com/cache/w444/ts/product/da/36/42/bbeb0fb81ca27c977a5fef9664323410.jpg',
                'price' => 50000,
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
