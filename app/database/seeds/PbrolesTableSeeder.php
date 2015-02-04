<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 3:29 PM
 * Ide:  PhpStorm
 */


class PbrolesTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();

       $pbRoles = array(
           array(
          'id'=>'1',
          'pbrole'=>'Player',
           ),

           array(
          'id'=>'2',
          'pbrole'=>'Coach',
           ),

           array(
          'id'=>'3',
          'pbrole'=>'Captain',
           )

       );
   
    DB::table('pbroles')->insert($pbRoles);
   }
   
}