<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/20/15
 * Time: 10:45 PM
 * Ide:  PhpStorm
 */
class SubtagsTableSeeder extends DatabaseSeeder {

    public function run()
    {

        Eloquent::unguard();

        $subtags = array(
            // Fields
            array(
                'id'     => '1',
                'subtag' => 'Carolina Paintball Field'
            ),
            array(
                'id'     => '2',
                'subtag' => 'La Muda Paintball Field'
            ),
            array(
                'id'     => '3',
                'subtag' => 'Caguas Paintball Field'
            ),
            array(
                'id'     => '4',
                'subtag' => 'Ositos Paintball Field'
            ),
            array(
                'id'     => '5',
                'subtag' => 'Carolina Paintball Field'
            ),
            array(
                'id'     => '10',
                'subtag' => 'X-jungle Paintball Field'
            ),

            //Stores
            array(
                'id'     => '6',
                'subtag' => 'Ozmio Paintball Store'
            ),
            array(
                'id'     => '7',
                'subtag' => 'Spy Quarters Paintball Shop'
            ),
            array(
                'id'     => '8',
                'subtag' => 'Adrenaline Paintball Shop'
            ),
            array(
                'id'     => '9',
                'subtag' => 'Area 51 Paintball Shop'
            ),


        );

        DB::table('subtags')->insert($subtags);


    }

}