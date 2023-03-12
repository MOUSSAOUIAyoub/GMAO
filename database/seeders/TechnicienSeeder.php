<?php

namespace Database\Seeders;
use App\Models\Technicien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnicienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Technicien::factory()
        ->count(10)
        ->create();
    }
}
