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
        return DB::transaction(function () use ($request) {

            $admin = new Admin();
            $admin->name = strtolower(preg_replace('/\s+/', '', $request->name));
            $admin->password = bcrypt($request->password);

            $token = $admin->createToken('adminToken')->plainTextToken;
        });
    }
}
