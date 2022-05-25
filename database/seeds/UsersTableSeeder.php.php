<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
         * Run the database seeds.
	      *
           * @return void
        */
    public function run()
        {
	      $max = 10;
	      for ($i = 0; $i < $max; $i++) {
        DB::table('users')->insert([
            'name' => "testuser{$i}",
            'email' => "test{$i}@gmail.com",
            'screen_name' => "test{$i}",
            'password' => bcrypt('testtest'),
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime()
            ]);
            }
	     }
    }
