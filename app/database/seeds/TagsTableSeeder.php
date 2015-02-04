<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/20/15
 * Time: 10:41 PM
 * Ide:  PhpStorm
 */
 

class TagsTableSeeder extends DatabaseSeeder {

   public function run(){
   
    Eloquent::unguard();
    
           $tags = array(
           array(
               'id' =>'1',
               'tag' =>'Event'
           ),
           array(
               'id' =>'2',
               'tag' =>'Photo'
           ),
           array(
               'id' =>'3',
               'tag' =>'News'
           ),
           array(
               'id' =>'4',
               'tag' =>'Fields'
           ),
           array(
               'id' =>'5',
               'tag' =>'Sales'
           ),
           array(
               'id' =>'6',
               'tag' =>'Store'
           ),
       );

       DB::table('tags')->insert($tags);

   
   
   }
   
}