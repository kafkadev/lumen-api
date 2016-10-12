<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        factory(App\Models\Category::class, 5)->create()->make();
    }
}
