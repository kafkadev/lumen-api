<?php

use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder {

    public function run()
    {
        factory(App\Models\PostTag::class, 100)->create()->make();
    }
}
