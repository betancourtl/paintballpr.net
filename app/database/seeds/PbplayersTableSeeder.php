<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 5:59 PM
 * Ide:  PhpStorm
 */
 

class PbplayersTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();
    
           $pbplayers = array(
           array(
               'id' =>'1',
               'player_image_id'=>'1',
               'player_user_id'=>'1',
               'player_division_id'=>'1',
               'player_score'=>''
           ),
           array(
               'id' =>'2',
               'player_image_id'=>'1',
               'player_user_id'=>'2',
               'player_division_id'=>'1',
               'player_score'=>''


           )
       );

       DB::table('pbplayers')->insert($pbplayers);

   
   
   }
   
}