<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
                'id'=>1, 'category_id'=>5, 'section_id'=>1,'product_name'=>'personal computer',
                'main_image'=>'', 'product_multiple_image'=>'', 'product_short_description'=>'',
                'fetures'=>'', 'filering_data'=>'', 'product_specification'=>'', 'status'=>1,
                'product_description'=>'good product', 'meta_title'=>'', 'meta_description'=>'', 'meta_keywords'=>''
            ]
        ];
        Product::insert($productRecords);
    }
}
