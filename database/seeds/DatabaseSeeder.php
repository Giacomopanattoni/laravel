<?php

use App\Models\Album;
use App\Models\Photo;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* disabilito il controllo delle foreign key */

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /* elimino i dati delle tabelle */

        User::truncate();
        Photo::truncate();
        Album::truncate();

        /* alimento le tabelle */

        $this->call(SeedUserTable::class);
        $this->call(seedAlbumTable::class);
        $this->call(SeedPhotoTable::class);
    }
}
