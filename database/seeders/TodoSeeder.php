<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()
        //     ->count(10)
        //     ->hasTodos(20)
        //     ->create();

        // User::factory()
        //     ->count(5)
        //     ->hasTodos(10)
        //     ->create();

        // User::factory()
        //     ->count(5)
        //     ->create();

        Todo::factory()
            ->count(10)
            ->hasAttachments(2)
            ->create();
    }
}
