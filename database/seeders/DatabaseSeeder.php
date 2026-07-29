<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (\App\Models\User::count() === 0) {
            \App\Models\User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $categories = [
            'ChatGPT Prompts',
            'Image Generation',
            'Code Assistant',
            'Content Writing',
            'Marketing',
            'Education',
            'Business',
            'Creative Writing',
        ];

        foreach ($categories as $name) {
            \App\Models\Category::firstOrCreate(['name' => $name]);
        }
    }
}
