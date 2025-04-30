<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Felsők', 'slug' => 'felso'],
            ['name' => 'Nadrágok', 'slug' => 'nadrag'],
            ['name' => 'Cipők', 'slug' => 'cipok'],
            ['name' => 'Kabátok', 'slug' => 'kabat'],
            ['name' => 'Egyéb ruházat', 'slug' => 'egyeb-ruhazat'],
            ['name' => 'Telefonok', 'slug' => 'telefon'],
            ['name' => 'Laptopok', 'slug' => 'laptop'],
            ['name' => 'Tabletek', 'slug' => 'tablet'],
            ['name' => 'Egyéb elektronika', 'slug' => 'egyeb-elektronika'],
            ['name' => 'Bútorok', 'slug' => 'butor'],
            ['name' => 'Dísztárgyak', 'slug' => 'disztargy'],
            ['name' => 'Egyéb háztartási cikkek', 'slug' => 'egyeb-haztartas'],
            ['name' => 'Sportfelszerelések', 'slug' => 'sportfelszereles'],
            ['name' => 'Edzőcipők', 'slug' => 'edzocipo'],
            ['name' => 'Egyéb sportfelszerelések', 'slug' => 'egyeb-sport'],
            ['name' => 'Szépirodalom', 'slug' => 'szepirodalom'],
            ['name' => 'Szakkönyvek', 'slug' => 'szakonyv'],
            ['name' => 'Egyéb könyvek', 'slug' => 'egyeb-konyv'],
            ['name' => 'Táblajátékok', 'slug' => 'tablajatek'],
            ['name' => 'Videójátékok', 'slug' => 'videojatek'],
            ['name' => 'Egyéb játékok', 'slug' => 'egyeb-jatek'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}