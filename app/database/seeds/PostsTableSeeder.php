<?php

class PostsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();


        $post = array(
            array(
                'id' => '1',
                'title'=>'New Paintball Marker on the Market!',
                'body'=>' uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
                'slug'=>'test-post-from-seeder-1',
                'draft'=>'0',
                'user_id'=>'1'),

            array(
                'title'=>'Angel bought be Kee action!',
                'id' => '2',
                'body'=>'aious versions have  purpose (injected humour and the like).',
                'slug'=>'test-post-from-seeder-2',
                'draft'=>'0',
                'user_id'=>'2'),

            array(
                'title'=>'Torneo 5 Vs 5 en Carolinat!',
                'id' => '3',
                'body'=>'ir infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
                'slug'=>'test-post-from-seeder',
                'draft'=>'0',
                'user_id'=>'3'),

            array(
                'title'=>'Especial del madrugador en Spy Quarters!',
                'id' => '4',
                'body'=>'  a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
                'slug'=>'test-post-from-seeder',
                'draft'=>'0',
                'user_id'=>'4'),

            array(
                'title'=>'Ozmio trae las Vanquish en $1499.00',
                'id' => '5',
                'body'=>' e Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
                'slug'=>'test-post-from-seeder',
                'draft'=>'0',
                'user_id'=>'5'),

        );
        DB::table('posts')->insert($post);
    }

}
