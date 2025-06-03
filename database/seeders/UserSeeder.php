<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RoleUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'password' => bcrypt('Super2025root')
        ]);

        RoleUser::create([
            'user_id' => $superadmin->id,
            'role' => 'superadmin',
        ]);

        $sentra = User::create([
            'name' => 'Nina',
            'username' => 'NFN',
            'password' => bcrypt('1234') // Password untuk user sentra
        ]);
        RoleUser::create([
            'user_id' => $sentra->id,
            'role' => 'Sentra',
        ]);
        $adhoc = User::create([
            'name' => 'Vira',
            'username' => 'VIRA',
            'password' => bcrypt('1234') // Password untuk user adhoc
        ]);
        RoleUser::create([
            'user_id' => $adhoc->id,
            'role' => 'Adhoc',
        ]);
        // Pelaksana;
        $pelaksana = User::create([
            'name' => 'Yuliska',
            'username' => 'YLK',
            'password' => bcrypt('1234') // Password untuk user pelaksana
        ]);
        RoleUser::create([
            'user_id' => $pelaksana->id,
            'role' => 'Pelaksana',
        ]);
        // Monev
        $monev = User::create([
            'name' => 'Heni',
            'username' => 'HNI',
            'password' => bcrypt('1234') // Password untuk user monev
        ]);
        RoleUser::create([
            'user_id' => $monev->id,
            'role' => 'Monev',
        ]);
        // Keuangan
        $keuangan = User::create([
            'name' => 'Bestia',
            'username' => 'BTS',
            'password' => bcrypt('1234') // Password untuk user keuangan
        ]);
        RoleUser::create([
            'user_id' => $keuangan->id,
            'role' => 'Keuangan',
        ]);
        // PIU
        $piu = User::create([
            'name' => 'Isti',
            'username' => 'ISM',
            'password' => bcrypt('1234') // Password untuk user PIU
        ]);
        RoleUser::create([
            'user_id' => $piu->id,
            'role' => 'PIU',
        ]);
        // Direktur
        $direktur = User::create([
            'name' => 'Dadang',
            'username' => 'DDS',
            'password' => bcrypt('1234') // Password untuk user direktur
        ]);
        RoleUser::create([
            'user_id' => $direktur->id,
            'role' => 'Direktur',
        ]);
    }
}
