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
        factory(App\Models\User::class)->create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@lumen-api.app',
            'password' => $hasher->make('admin'),
            'role' => 1,
        ]);
        factory(App\Models\User::class, 50)->create()->make();
    }
}
