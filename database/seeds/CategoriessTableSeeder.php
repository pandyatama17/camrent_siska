<?php

use Illuminate\Database\Seeder;

class CategoriessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([
          'cat_name' => 'DSLR',
      ]);
      DB::table('categories')->insert([
          'cat_name' => 'Mirrorless',
      ]);
      DB::table('categories')->insert([
          'cat_name' => 'Lenses',
      ]);
      DB::table('categories')->insert([
          'cat_name' => 'Speedlights',
      ]);
      DB::table('categories')->insert([
          'cat_name' => 'Tripods',
      ]);
    }
}
