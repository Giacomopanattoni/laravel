<?php

use Illuminate\Database\Seeder;
use App\Models\Album;

class seedAlbumTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Album::truncate();
        factory(App\Models\Album::class , 10) ->create();  /* richiama la factori creata in app\database\factories\UserFactory */

    }
}
