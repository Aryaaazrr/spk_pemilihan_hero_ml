<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\GameplayType;
use App\Models\Kriteria;
use App\Models\Role;
use App\Models\Subkriteria;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Admin', 'Pengguna'
        ];

        foreach ($data as $value) {
            Role::insert([
                'nama_role' => $value
            ]);
        }

        User::factory()->create([
            'username'          => 'Admin',
            'password'          => Hash::make('admin'),
            'id_role'          => 1,
        ]);

        User::factory()->create([
            'username'          => 'User',
            'password'          => Hash::make('user'),
            'id_role'          => 2,
        ]);

        $types = ['Team Fight', 'Pick Off', 'Split Push'];
        foreach ($types as $type) {
            GameplayType::create([
                'nama' => $type
            ]);
        }

        $kriteria = ['Durability', 'Offense', 'Control Effect', 'Difficulty'];
        foreach ($kriteria as $k) {
            Kriteria::create([
                'nama' => $k
            ]);
        }

        $kriteriaData = [
            1 => [
                ['subkriteria' => 'Sangat Lemah Sekali', 'nilai' => 1],
                ['subkriteria' => 'Sangat Lemah', 'nilai' => 2],
                ['subkriteria' => 'Lemah', 'nilai' => 3],
                ['subkriteria' => 'Cukup Lemah', 'nilai' => 4],
                ['subkriteria' => 'Sedang', 'nilai' => 5],
                ['subkriteria' => 'Cukup Kuat', 'nilai' => 6],
                ['subkriteria' => 'Kuat', 'nilai' => 7],
                ['subkriteria' => 'Sangat Kuat', 'nilai' => 8],
                ['subkriteria' => 'Sangat Kuat Sekali', 'nilai' => 9],
                ['subkriteria' => 'Sangat Sangat Kuat Sekali', 'nilai' => 10],
            ],
            2 => [
                ['subkriteria' => 'Sangat Lemah Sekali', 'nilai' => 1],
                ['subkriteria' => 'Sangat Lemah', 'nilai' => 2],
                ['subkriteria' => 'Lemah', 'nilai' => 3],
                ['subkriteria' => 'Cukup Lemah', 'nilai' => 4],
                ['subkriteria' => 'Sedang', 'nilai' => 5],
                ['subkriteria' => 'Cukup Kuat', 'nilai' => 6],
                ['subkriteria' => 'Kuat', 'nilai' => 7],
                ['subkriteria' => 'Sangat Kuat', 'nilai' => 8],
                ['subkriteria' => 'Sangat Kuat Sekali', 'nilai' => 9],
                ['subkriteria' => 'Sangat Sangat Kuat Sekali', 'nilai' => 10],
            ],
            3 => [
                ['subkriteria' => 'Sangat Lemah Sekali', 'nilai' => 1],
                ['subkriteria' => 'Sangat Lemah', 'nilai' => 2],
                ['subkriteria' => 'Lemah', 'nilai' => 3],
                ['subkriteria' => 'Cukup Lemah', 'nilai' => 4],
                ['subkriteria' => 'Sedang', 'nilai' => 5],
                ['subkriteria' => 'Cukup Kuat', 'nxilai' => 6],
                ['subkriteria' => 'Kuat', 'nilai' => 7],
                ['subkriteria' => 'Sangat Kuat', 'nilai' => 8],
                ['subkriteria' => 'Sangat Kuat Sekali', 'nilai' => 9],
                ['subkriteria' => 'Sangat Sangat Kuat Sekali', 'nilai' => 10],
            ],
            4 => [
                ['subkriteria' => 'Sangat Mudah Sekali', 'nilai' => 1],
                ['subkriteria' => 'Sangat Mudah', 'nilai' => 2],
                ['subkriteria' => 'Mudah', 'nilai' => 3],
                ['subkriteria' => 'Cukup Mudah', 'nilai' => 4],
                ['subkriteria' => 'Sedang', 'nilai' => 5],
                ['subkriteria' => 'Cukup Sulit', 'nilai' => 6],
                ['subkriteria' => 'Sulit', 'nilai' => 7],
                ['subkriteria' => 'Sangat Sulit', 'nilai' => 8],
                ['subkriteria' => 'Sangat Sulit Sekali', 'nilai' => 9],
                ['subkriteria' => 'Sangat Sangat Sulit Sekali', 'nilai' => 10],
            ]
        ];

        foreach ($kriteriaData as $kriteriaId => $subkriterias) {
            foreach ($subkriterias as $subkriteria) {
                Subkriteria::create([
                    'id_kriteria' => $kriteriaId,
                    'subkriteria' => $subkriteria['subkriteria'],
                    'nilai' => $subkriteria['nilai']
                ]);
            }
        }
    }
}