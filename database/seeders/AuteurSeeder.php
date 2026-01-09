<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AuteurSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('auteurs')->insert([
            [
                'nom' => 'Dupont',
                'prenom' => 'Jean',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Martin',
                'prenom' => 'Claire',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Bernard',
                'prenom' => 'Lucas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Durand',
                'prenom' => 'Sophie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Petit',
                'prenom' => 'Thomas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Moreau',
                'prenom' => 'Emma',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Fournier',
                'prenom' => 'Nicolas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Girard',
                'prenom' => 'Laura',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Lefevre',
                'prenom' => 'Antoine',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Roux',
                'prenom' => 'Camille',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
