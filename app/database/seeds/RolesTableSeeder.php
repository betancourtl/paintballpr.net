<?php
/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 12/3/14
 * Time: 2:19 PM
 */

class RolesTableSeeder extends seeder {

    public function run()
    {

        Eloquent::unguard();

        $roles = array(
            array(
                'id' => '1',
                'role' => 'Administrator'
            ),
            array(
                'id' => '2',
                'role' => 'Moderator'
            ),
            array(
                'id' => '3',
                'role' => 'Editor'
            ),
            array(
                'id' => '4',
                'role' => 'User'
            )
        );

        DB::table('roles')->insert($roles);
    }//end of seeder
} //end of class