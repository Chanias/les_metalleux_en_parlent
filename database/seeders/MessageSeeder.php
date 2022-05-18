<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::create([
            'user_id'=>2,
            'content'=>'Bien le bonjour, amis metalleux. Voici un message créé via un seeder, HAHAHA',
            'tags'=>'#nouveau',
        ]);
        Message::factory(10)->create();
    }
    
}
