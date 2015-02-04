<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/31/15
 * Time: 10:11 PM
 * Ide:  PhpStorm
 */
 

class BannersTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();
    
           $banners = array(
           array(
               'id' =>'1',
               'banner_name' => 'default-1.jpg',
               'banner_description'=>'paintballpr.net',
               'begin_date'=>'',
               'end_date'=>'',
               'default_banner_image' => '1'


           ),
           array(
               'id' =>'2',
               'banner_name' => 'default-2.jpg',
               'banner_description'=>'paintballpr.net',
               'begin_date'=>'',
               'end_date'=>'',
               'default_banner_image' => '1'

           )
       );

       DB::table('banners')->insert($banners);

   
   
   }
   
}