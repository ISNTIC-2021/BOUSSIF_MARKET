<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'email' => 'admin@ofppt-edu.ma'
        ], [
            'first_name' => 'Admin',
            'last_name' => 'admin',
            'email'=>'admin@ofppt-edu.ma',
            'password' => bcrypt('ista@2023')
        ]);
    }
}
