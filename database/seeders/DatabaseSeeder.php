<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            userSeeder::class,
            FournisseurSeeder::class,
            ArticleSeeder::class,
            CommandeSeeder::class,
            technicienSeeder::class,
            ClientSeeder::class,
            SiteSeeder::class,
            InterventionSeeder::class,
            //DocumentSeeder::class,
            BatimentSeeder::class,
            EquipementSeeder::class,
            SousequipementSeeder::class,
        ]);
    }
}
