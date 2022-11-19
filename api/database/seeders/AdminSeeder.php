<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Payment;
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
        $admin->is_admin = true;
        $admin->save();

        $token = $admin->createToken('adminToken')->plainTextToken;

        $ph_no = '09123456789';

        for ($i = 1; $i < 5; $i++) {
            $payment = new Payment();
            $payment->ph_no = $ph_no;
            $payment->type = $i;
            $payment->admin_id = $admin->id;
            $payment->save();
        }
    }

}
