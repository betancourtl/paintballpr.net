<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('RolesTableSeeder');     // fills the roles table
        $this->call('UsersTableSeeder');     //fills the users   table
        $this->call('CatsTableSeeder');     //fills categories table
        $this->call('MessagesTableSeeder'); // fills messages  table
        //PaintballEvents
        $this->call('PbdivisionsTableSeeder');     // fills the divisions table
        $this->call('PbeventsTableSeeder');     //fills pbevents table
        $this->call('PbteamsTableSeeder'); // fills pbteams  table
        $this->call('PbeventspbteamsTableSeeder');     //fills the pbteams_pbevents  table
        $this->call('PbrolesTableSeeder'); // fills pbroles  table
        $this->call('pbgamesTableSeeder'); //Fills the pbgames table
        $this->call('PbimagesTableSeeder'); //Fills the pbgames table
        $this->call('PbplayersTableSeeder'); //Fills the pbgames table
        $this->call('PbplayerspbteamsTableSeeder'); //Fills the pbgames table
        $this->call('SubtagsTableSeeder'); //Fills the subtags
        $this->call('TagsTableSeeder'); // Fills that tags
        $this->call('BannersTableSeeder'); // Fills the banners default images

        //	 $this->call('PostsTableSeeder');
    }

}
