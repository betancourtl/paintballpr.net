<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 3:44 PM
 * Ide:  PhpStorm
 */
 

class PbeventsTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();
    
           $pbevents = array(
           array(
               'id' =>'1',
               'event' =>'Carolina Paintball Field Open',
               'date' => '01/24/15'
           ),
               array(
               'id' =>'2',
               'event' =>'5 Man Challenge 5.0',
               'date' => '02/13/15'
           )
       );

       DB::table('pbevents')->insert($pbevents);

   
   
   }
   
}