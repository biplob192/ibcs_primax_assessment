<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'phone' => '01725361208',
            'password' => Hash::make('password'),
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '01725361209',
            'password' => Hash::make('password'),
        ]);

        $employee = User::create([
            'name' => 'Employee',
            'email' => 'employee@gmail.com',
            'phone' => '01725361210',
            'password' => Hash::make('password'),
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '01725361211',
            'password' => Hash::make('password'),
        ]);


        $superAdmin->assignRole('Super_Admin');
        $admin->assignRole('Admin');
        $employee->assignRole('Employee');
        $user->assignRole('User');


        // Creating bulk amount of users!!
        for ($i = 0; $i < 100000; $i++) {
            $data[] = [
                'name'                  => fake()->name(),
                'email'                 => fake()->unique()->safeEmail(),
                'phone'                 => fake()->phoneNumber(),
                'password'              => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'email_verified_at'     => now(),
                'remember_token'        => Str::random(10),
                'created_at'            => now(),
            ];
        }

        $chunks = array_chunk($data, 1000);
        foreach ($chunks as $chunk) {
            User::insert($chunk);
        }
    }
}
