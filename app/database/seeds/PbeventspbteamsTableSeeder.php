<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 3:49 PM
 * Ide:  PhpStorm
 */
 

class PbeventspbteamsTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();
    
           $pbevents_pbteams = array(
           array(
               'id' =>'1',
               'event_id' =>'1',
               'event_team_id' =>'1',
           ),
               array(
               'id' =>'2',
               'event_id' =>'1',
               'event_team_id' =>'2',
           )
       );

       DB::table('pbevents_pbteams')->insert($pbevents_pbteams);

   
   
   }
   
}