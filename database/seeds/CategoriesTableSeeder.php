<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        // factory(App\Models\Category::class, 5)->create()->make();
        factory(App\Models\Category::class)->create(
            [
            	'id' => 1,
                'name' => 'Information Technology',
                'slug' => 'information-technology',
            ]
        );
        factory(App\Models\Category::class)->create(
            [
                'id' => 2,
                'name' => 'Cakes',
                'slug' => 'cakes',
            ]
        );
    }
}
