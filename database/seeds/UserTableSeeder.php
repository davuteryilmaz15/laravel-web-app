<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            "name" => "Davut ERYILMAZ",
            "email" => "davuteryilmaz15@gmail.com",
            "password" => bcrypt("123456")
        ]);

        DB::table('role_user')->insert(["user_id" => 1, "role_id" => 1]);
        DB::table('role_user')->insert(["user_id" => 1, "role_id" => 2]);
        DB::table('role_user')->insert(["user_id" => 1, "role_id" => 3]);
    }
}
