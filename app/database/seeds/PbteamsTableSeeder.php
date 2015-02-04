<?php

/**
 * Created by PhpStorm.
 * User: luisbetancourt
 * Date: 1/9/15
 * Time: 3:41 PM
 * Ide:  PhpStorm
 */
class PbteamsTableSeeder extends DatabaseSeeder {

    public function run()
    {

        Eloquent::unguard();
//password is 123qweQWE unhashed
        $pbteams = array(
            array(
                'id'            => '1',
                'name'          => 'Raptors',
                'team_password' => '$2y$10$gnGcPMqz2KNdWCM0fro1V.FrIUM/mhRkqFEDkxRkmSNZ1y8X4c16e',
                'division_id'   => '1'
            ),
            array(
                'id'            => '2',
                'name'          => 'inertia',
                'team_password' => '$2y$10$gnGcPMqz2KNdWCM0fro1V.FrIUM/mhRkqFEDkxRkmSNZ1y8X4c16e',
                'division_id'   => '1'
            ),
            array(
                'id'            => '3',
                'name'          => 'Fury',
                'team_password' => '$2y$10$gnGcPMqz2KNdWCM0fro1V.FrIUM/mhRkqFEDkxRkmSNZ1y8X4c16e',
                'division_id'   => '1'

            ),
            array(
                'id'            => '4',
                'name'          => 'Mozambique',
                'team_password' => '$2y$10$gnGcPMqz2KNdWCM0fro1V.FrIUM/mhRkqFEDkxRkmSNZ1y8X4c16e',
                'division_id'   => '1'

            )
        );

        DB::table('pbteams')->insert($pbteams);


    }

}