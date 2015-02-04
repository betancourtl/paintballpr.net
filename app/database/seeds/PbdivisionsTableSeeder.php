<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 3:22 PM
 * Ide:  PhpStorm
 */

// Inserts the paintball divisions into the database
class PbdivisionsTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();

       $divisions = array(
           array(
               'id' =>'1',
               'division' => 'D1'
           ),
           array(
               'id' =>'2',
               'division' => 'D2'
           ),
           array(
               'id' =>'3',
               'division' => 'D3'
           ),
           array(
               'id' =>'4',
               'division' => 'D4'
           ),
           array(
               'id' =>'5',
               'division' => 'D5'
           ),
           array(
               'id' =>'6',
               'division' => 'Open'
           )
       );
   
   DB::table('pbdivisions')->insert($divisions);
   }
   
}