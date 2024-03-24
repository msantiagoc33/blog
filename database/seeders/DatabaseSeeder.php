<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /**
         * Con la ayuda de use Illuminate\Support\Facades\Storage;
         * primero borrar la carpeta si exite y luego crea esta carpeta, posts, en store que es donde se guardaran la imagenes
         * este es para que no se acumulen las imagenes haciendo pruebas
         */
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        // $this->call(UserSeeder::class); // inclusion del seeder creado para que incluya mis datos
        Category::factory(6)->create();
        Tag::factory(8)->create();
        $this->call(PostSeeder::class); // inclusion del seeder creado para que incluya los posts con la imagenes
    }
}
 