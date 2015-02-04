<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/12/15
 * Time: 9:55 AM
 * Ide:  PhpStorm
 */
 

class PbplayersPbteams extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();
    
           $pbplayers_pbteams = array(
           array(
               'id' =>'1',
               'player_team_id' => '2',
               'player_id' =>'1'
           ),
           array(
               'id' =>'1',
               'player_team_id' => '3',
               'player_id' =>'2'
           ),

       );

       DB::table('pbplayers_pbteams')->insert($pbplayers_pbteams);

   
   
   }
   
}