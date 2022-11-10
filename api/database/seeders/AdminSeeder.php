<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'admin';
        $admin->password = bcrypt('password123');
        $admin->save();

        $token = $admin->createToken('adminToken')->plainTextToken;
    }
}
