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
            \App\Models\Category::create(['name' => $name]);
        }
    }
}
