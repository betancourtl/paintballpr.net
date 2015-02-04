<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 12/3/14
 * Time: 2:18 PM
 */
class CatsTableSeeder extends seeder {

    public function run()
    {

        Eloquent::unguard();

        $cats = array(
            array(
                'id'       => '1',
                'category' => 'News'
            ),
            array(
                'id'       => '2',
                'category' => 'Photo'
            ),
            array(
                'id'       => '3',
                'category' => 'Article'
            ),
            array(
                'id'       => '4',
                'category' => 'Event'
            ),
            array(
                'id'       => '5',
                'category' => 'Sales'
            ),
        );

        //insert into database
        DB::table('cats')->insert($cats);
    }//end of class

} 