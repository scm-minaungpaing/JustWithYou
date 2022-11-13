<?php

namespace App\Dao\Admin;

use App\Contracts\Dao\Admin\AdminDaoInterface;
use App\Models\Admin;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDao implements AdminDaoInterface {
    public function test()
    {
        return response()->json(['message' => 'OK from Dao']);
    }

    public function register(Request $request)
    {
        // return DB::transaction(function () use ($request) {

        //     $payment = new Payment();
        //     $payment->admin_id = 1; // need to change
        //     $payment->type = 1; // 1 for kpay
        //     $payment->ph_no = $request->kpay; // need to change
        // });
        return response()->json(['message' => 'OK from admin-dao']);
    }
}
