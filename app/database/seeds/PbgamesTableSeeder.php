<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 5:37 PM
 * Ide:  PhpStorm
 */
 

class PbgamesTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();
    
           $pbgames = array(
           array(
               'id' =>'1',
               'team_1_id' => '1',
               'team_2_id' => '2',
               'pbgames_event_id' => '2'
           )
       );

       DB::table('pbgames')->insert($pbgames);

   
   
   }
   
}