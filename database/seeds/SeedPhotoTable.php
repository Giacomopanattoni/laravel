<?php

use App\Models\Photo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedPhotoTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Photo::class , 200) ->create();  /* richiama la factori creata in app\database\factories\ModelFactory */

    }
}
