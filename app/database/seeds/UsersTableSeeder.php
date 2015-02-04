<?php

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();


        $users = array(
            array(
                'id'        => '1',
                'username'  => 'Luis',
                'password'  => Hash::make('123qweQWE'),
                'email'     => 'usmc.betancourt@gmail.com',
                'role_id'   => '4'), // user

            array(
                'id'        => '2',
                'username'  => 'paintballpr.net',
                'password'  => Hash::make('123qweQWE'),
                'email'     => 'paintballpr.net@gmail.com',
                'role_id'   => '1') // admin
        );


        DB::table('users')->insert($users);
    }

}
