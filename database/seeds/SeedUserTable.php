<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;

class SeedUserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* for($i = 0; $i < 30; $i++){
            DB::table('users')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10) . "@gmail.com",
                'password' => Hash::make('password')
            ]);
        } */
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        factory(App\User::class , 30) ->create();  /* richiama la factori creata in app\database\factories\UserFactory */

    }
}
