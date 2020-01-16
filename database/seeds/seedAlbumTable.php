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
        
        factory(App\Models\Album::class , 10) ->create();  /* richiama la factori creata in app\database\factories\UserFactory */

    }
}
