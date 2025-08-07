<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GunType;

class GunTypeSeeder extends Seeder
{
    public function run(): void
    {
        GunType::insert([
            ['name' => 'Pistol', 'soft_delete' => false],
            ['name' => 'Senapan', 'soft_delete' => false],
            ['name' => 'Pelontar Gas Air Mata', 'soft_delete' => false],
        ]);
    }
}
