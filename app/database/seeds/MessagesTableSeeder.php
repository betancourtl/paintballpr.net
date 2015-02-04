<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 12/30/14
 * Time: 6:36 PM
 * Ide:  PhpStorm
 */

class MessagesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();


        $messages = array(
            array(
                'id'        => '1',
                'title'  => 'Luis',
                'message'  => Hash::make('123qweQWE'),
                'user_from'     => '1',
                'read' => '0',
                'user_to'   => '2'), // user

            array(
                'id'        => '2',
                'title'  => 'Luis',
                'message'  => 'DB seeder Message',
                'user_from'     => '1',
                'read' => '0',
                'user_to'   => '2'), // user

            array(
                'id'        => '3',
                'title'  => 'Luis',
                'message'  => 'DB seeder Message',
                'user_from'     => '2',
                'read' => '0',
                'user_to'   => '1'), // user

            array(
                'id'        => '4',
                'title'  => 'Luis',
                'message'  =>'DB seeder Message',
                'user_from'     => '1',
                'read' => '0',
                'user_to'   => '2'), // user

        );


        DB::table('messages')->insert($messages);
    }


}