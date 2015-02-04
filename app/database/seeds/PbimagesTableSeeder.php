<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 6:04 PM
 * Ide:  PhpStorm
 */
 

class PbimagesTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();
    
           $pbimages = array(
           array(
               'id' =>'1',
               'filename' =>'default_player.jpg'
           )
       );

       DB::table('pbimages')->insert($pbimages);

   
   
   }
   
}