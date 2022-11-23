<?php

namespace App\Dao\Admin;

use App\Contracts\Dao\Admin\AdminDaoInterface;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDao implements AdminDaoInterface {

    public function register(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $admin = new Admin();
            $admin->name = strtolower(preg_replace('/\s+/', '', $request->name));
            $admin->password = bcrypt($request->password);
            $admin->save();

            $token = $admin->createToken('adminToken')->plainTextToken;

            return response()->json(['message' => 'Register Successfully!', 'status' => 200 ], 200);
        });
    }

    public function getAllUsers()
    {
        return Admin::where('is_admin', '!=',1)->select('name','id')->get();
    }
}
