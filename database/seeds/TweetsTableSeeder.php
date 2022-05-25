<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TweetsTableSeeder extends Seeder
{
    /**
         * Run the database seeds.
      *
           * @return void
        */
    public function run()
        {

             DB::table('users')->insert([
             'name' => 'test',
             'email' => 'test@gmail.com',
             'screen_name' => 'test',
             'password' => bcrypt('test'),
             'created_at' => new \DateTime(),
             'updated_at' => new \DateTime()
            ]);
        }
}
