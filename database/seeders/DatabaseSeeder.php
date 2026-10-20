<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $types = RoomType::factory()
            ->count(4)
            ->create();

        Room::factory()
            ->count(22)
            ->recycle($types)
            ->create();
    }
}
