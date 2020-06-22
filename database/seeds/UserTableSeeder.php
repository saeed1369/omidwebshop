<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
        							"name" =>"ali",
        							"email" =>"ali@gmail.com",
        							"password" =>Hash::make("password"),
						        ]);
  
    }
}
