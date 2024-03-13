<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ChaptersTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(QuransTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(TranslationsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(PartsTableSeeder::class);
    }
}
