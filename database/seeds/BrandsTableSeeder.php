<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('brands')->insert([
          'brand_name' => 'Canon',
      ]);
      DB::table('brands')->insert([
          'brand_name' => 'Nikon',
      ]);
      DB::table('brands')->insert([
          'brand_name' => 'Sony',
      ]);
      DB::table('brands')->insert([
          'brand_name' => 'Fujifilm',
      ]);
      DB::table('brands')->insert([
          'brand_name' => 'Leica',
      ]);
    }
}
