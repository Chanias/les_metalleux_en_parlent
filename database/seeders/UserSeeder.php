<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'pseudo' => 'John ',
            'password' => Hash::make('Diablo18!'),
            'email' => 'john@yahoo.com',
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'pseudo' => 'Floriane ',
            'password' => Hash::make('Blablabla!'),
            'email' => 'floriane@yahoo.com',
            'remember_token' => Str::random(10),
        ]);
    }
}
