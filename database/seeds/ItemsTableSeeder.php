<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('items')->insert([
          'name' => 'Canon EOS 60D',
          'category' => '1',
          'brand' => '1',
          'rent_price' => '100000',
          'bail_price' => '100000',
          'description' => '</b>An EOS with Perspective</b>. <br>With the new EOS 60D DSLR, Canon gives the photo enthusiast a powerful tool fostering creativity, with better image quality, more advanced features and automatic and in-camera technologies for ease-of-use. It features an improved APS-C sized 18.0 Megapixel CMOS sensor for tremendous images, a new DIGIC 4 Image Processor for finer detail and excellent color reproduction, and improved ISO capabilities from 100 - 6400 (expandable to 12800) for uncompromised shooting even in the dimmest situations. The new Multi-control Dial enables users to conveniently operate menus and enter settings with a simple touch. The EOS 60D also features an EOS first: A Vari-angle 3.0-inch Clear View LCD (1,040,000 dots) monitor for easy low- or high-angle viewing. An improved viewfinder, a number of new in-camera creative options and filters',
          'rented_times' => 0,
          'stock' => 5,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon EOS 70D',
          'category' => '1',
          'brand' => '1',
          'rent_price' => '120000',
          'bail_price' => '100000',
          'description' => '</b>Meet The New Game-Changer</b>. <br>Changing the way users capture still images and video with a DSLR camera, Canon proudly introduces the EOS 70D – a trailblazing powerhouse featuring a revolutionary autofocus technology that unlocks the potential of Live View: Dual Pixel CMOS AF. This game-changing technology allows the EOS 70D to capture video in Live View with smooth and precise autofocus similar to that of a camcorder, complete with the superb image quality that is a hallmark of EOS cameras. Additionally, Dual Pixel CMOS AF provides fast and accurate autofocus during Live View still image capture, enabling you to fully benefit from the freedom of angle allowed by the Vari-angle Touch Screen 3.0-inch Clear View LCD monitor II. Compositional options are now nearly limitless with the two real-world choices of Live View and viewfinder shooting.',
          'rented_times' => 0,
          'stock' => 2,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon EOS 80D',
          'category' => '1',
          'brand' => '1',
          'rent_price' => '125000',
          'bail_price' => '100000',
          'description' => '</b>Focus With Precision</b>. <br>Whether raising your game to SLR level photography or having fun with a feature-rich, versatile SLR you can use pretty much anywhere, the EOS 80D camera is your answer. It features an impressive 45-point all cross-type AF system* that provides high-speed, highly precise AF in virtually any kind of light. To help ensure photographers don\'t miss their shot, an Intelligent Viewfinder with approximately 100% coverage provides a clear view and comprehensive image data. Improvements like a powerful 24.2 Megapixel (APS-C) CMOS sensor and Dual Pixel CMOS AF for Live View shooting enhance the EOS 80D\'s performance across the board. Complementing the EOS 80D\'s advanced operation are built-in wireless connectivity and Full HD 60p movies that can be saved as MP4s for easy sharing. Merging power, precision and operability, the EOS 80D is a dynamic SLR camera for anyone ready to realize their creative vision.',
          'rented_times' => 0,
          'stock' => 3,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon EOS 5D Mark IV',
          'category' => '1',
          'brand' => '1',
          'rent_price' => '175000',
          'bail_price' => '100000',
          'description' => '</h4>See Legendary</h4>. <br><p>The EOS 5D Mark IV camera builds on the powerful legacy of the 5D series, offering amazing refinements in image quality, performance and versatility. Canon\'s commitment to imaging excellence is the soul of the EOS 5D Mark IV. Wedding and portrait photographers, nature and landscape shooters, as well as creative videographers will appreciate the brilliance and power that the EOS 5D Mark IV delivers. Superb image quality is achieved with Canon\'s all-new 30.4 Megapixel full-frame sensor, and highly-detailed 4K video is captured with ease. Focus accuracy has been improved with a refined 61-point AF system and Canon\'s revolutionary Dual Pixel CMOS AF for quick, smooth AF for both video and Live View shooting. Fast operation is enhanced with Canon\'s DIGIC 6+ Image Processor, which provides continuous shooting at up to 7.0 fps. Built-in Wi-Fi®, GPS and an easy-to-navigate touch-panel LCD allow the camera to become an</p>',
          'rented_times' => 0,
          'stock' => 2,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon EF 50mm f/1.8',
          'category' => '3',
          'brand' => '1',
          'rent_price' => '25000',
          'bail_price' => '10000',
          'description' => 'Fixed Lens',
          'rented_times' => 0,
          'stock' => 8,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon EF 70-200mm f/2.8l IS II USM',
          'category' => '3',
          'brand' => '1',
          'rent_price' => '100000',
          'bail_price' => '100000',
          'description' => 'Tele Lens',
          'rented_times' => 0,
          'stock' => 3,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon EF 8-15mm f/4L USM',
          'category' => '3',
          'brand' => '1',
          'rent_price' => '75000',
          'bail_price' => '50000',
          'description' => 'Fixed Lens',
          'rented_times' => 0,
          'stock' => 4,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon EF 50mm f/1.2L USM',
          'category' => '3',
          'brand' => '1',
          'rent_price' => '75000',
          'bail_price' => '50000',
          'description' => 'Fixed Lens',
          'rented_times' => 0,
          'stock' => 8,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon Speedlite 430 EXII',
          'category' => '4',
          'brand' => '1',
          'rent_price' => '50000',
          'bail_price' => '50000',
          'description' => 'Silo Men',
          'rented_times' => 0,
          'stock' => 3,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Nikon D750',
          'category' => '1',
          'brand' => '2',
          'rent_price' => '75000',
          'bail_price' => '75000',
          'description' => 'Kamera tua',
          'rented_times' => 0,
          'stock' => 3,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Nikon D90',
          'category' => '1',
          'brand' => '2',
          'rent_price' => '75000',
          'bail_price' => '75000',
          'description' => 'ni kamera malah lebih tua',
          'rented_times' => 0,
          'stock' => 3,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'AF Nikkor 50mm f/1.8D',
          'category' => '3',
          'brand' => '2',
          'rent_price' => '50000',
          'bail_price' => '50000',
          'description' => 'Lensa fix jadul',
          'rented_times' => 0,
          'stock' => 3,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon EOS M5',
          'category' => '2',
          'brand' => '1',
          'rent_price' => '150000',
          'bail_price' => '100000',
          'description' => 'Mirrorless cuyyyyy',
          'rented_times' => 0,
          'stock' => 4,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Sony Alpha 7II (A72)',
          'category' => '2',
          'brand' => '3',
          'rent_price' => '150000',
          'bail_price' => '100000',
          'description' => 'Mirrorless cuyyyyy',
          'rented_times' => 0,
          'stock' => 2,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Sony Alpha 7s (A7s)',
          'category' => '2',
          'brand' => '3',
          'rent_price' => '175000',
          'bail_price' => '100000',
          'description' => 'Mirrorless cuyyyyy',
          'rented_times' => 0,
          'stock' => 4,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Fujifilm XT-10',
          'category' => '2',
          'brand' => '4',
          'rent_price' => '175000',
          'bail_price' => '100000',
          'description' => 'Mirrorless cuyyyyy',
          'rented_times' => 0,
          'stock' => 4,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Fujifilm XT-1',
          'category' => '2',
          'brand' => '4',
          'rent_price' => '125000',
          'bail_price' => '100000',
          'description' => 'Mirrorless cuyyyyy',
          'rented_times' => 0,
          'stock' => 3,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Leica M10',
          'category' => '2',
          'brand' => '5',
          'rent_price' => '1000000',
          'bail_price' => '500000',
          'description' => 'Mirrorless cuyyyyy',
          'rented_times' => 0,
          'stock' => 1,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
      DB::table('items')->insert([
          'name' => 'Canon 1DX Mark III',
          'category' => '1',
          'brand' => '1',
          'rent_price' => '1000000',
          'bail_price' => '500000',
          'description' => 'KAMERA MAHALLLL',
          'rented_times' => 0,
          'stock' => 1,
          'rating' => 0,'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
}
