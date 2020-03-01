<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
          'first_name' => 'admin',
          'last_name' => '1',
          'email' => 'admin@gmail.com',
          'password' => Hash::make('admin'),
          'phone' => mt_rand(100000000000, 999999999999),
          'verification_id' => mt_rand(100000000000, 999999999999),
          'verified' => 1,
          'isadmin' => 1,
          'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('users')->insert([
          'first_name' => 'nanda',
          'last_name' => 'pandyatama',
          'email' => 'pandyatama@gmail.com',
          'password' => Hash::make('nanda'),
          'phone' => mt_rand(100000000000, 999999999999),
          'verification_id' => mt_rand(100000000000, 999999999999),
          'verified' => 1,
          'isadmin' => 0,
          'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
}
