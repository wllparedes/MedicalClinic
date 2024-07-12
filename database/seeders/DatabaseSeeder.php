<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\User;
use Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $days = [
        //     ['name' => 'Lunes', 'cod' => 'MO', 'its_workday' => 1],
        //     ['name' => 'Martes', 'cod' => 'TU', 'its_workday' => 1],
        //     ['name' => 'Miércoles', 'cod' => 'WE', 'its_workday' => 1],
        //     ['name' => 'Jueves', 'cod' => 'TH', 'its_workday' => 1],
        //     ['name' => 'Viernes', 'cod' => 'FR', 'its_workday' => 1],
        //     ['name' => 'Sábado', 'cod' => 'SA', 'its_workday' => 0],
        //     ['name' => 'Domingo', 'cod' => 'SU', 'its_workday' => 0],
        // ];

        // foreach ($days as $day) {
        //     Day::create($day);
        // }

        // User::create([
        //     'names' => 'Wallace',
        //     'last_names' => 'Graham',
        //     'username' => 'wallace',
        //     'slug' => 'wgraham',
        //     'gender' => 'H',
        //     'dni' => '12345678',
        //     'phone' => '12345678',
        //     'emergency_phone' => '12345678',
        //     'nationality' => 'PE',
        //     'role' => 'admin',
        //     'active' => 1,
        //     'email' => 'walin@',
        //     'password' => Hash::make('wallace'),
        // ]);
    }
}
