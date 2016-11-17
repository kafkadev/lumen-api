<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hasher = app()->make('hash');
        factory(App\Models\User::class)->create(
            [
                'name' => 'Tiep Pt',
                'username' => 'tiep1293',
                'email' => 'tieppt07@gmail.com',
                'password' => $hasher->make('nokiae63'),
                'role' => 1,
            ]
        );
        factory(App\Models\User::class)->create(
            [
                'name' => 'Thao NP',
                'username' => 'thaonp',
                'email' => 'thaonptlu@gmail.com',
                'password' => $hasher->make('iphone5slock'),
                'role' => 1,
            ]
        );
        // factory(App\Models\User::class, 50)->create()->make();
    }
}
