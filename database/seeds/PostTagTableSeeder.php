<?php

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder {

    public function run()
    {
        factory(App\Models\Category::class, 100)->create()->make();
    }
}
