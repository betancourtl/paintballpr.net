<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/13/15
 * Time: 3:56 PM
 * Ide:  PhpStorm
 */
 

class PbplayerspbteamsTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();
    
           $pbplayers_pbteams = array(
           array(
               'id' =>'1',
               'player_team_id' => '1',
               'player_id' => '1',
               'player_role_id'=>'1'
           ),
           array(
               'id' =>'2',
               'player_team_id' => '1',
               'player_id' => '2',
               'player_role_id'=>'1'

           ),
       );

       DB::table('pbplayers_pbteams')->insert($pbplayers_pbteams);

   
   
   }
   
}