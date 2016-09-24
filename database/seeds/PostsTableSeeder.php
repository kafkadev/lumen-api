<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder {

	public function run()
	{
		factory(App\Models\Post::class, 100)->create()->make();
	}
}
