<?php

namespace App\Dao\Admin;

use App\Contracts\Dao\Admin\AdminDaoInterface;

class AdminDao implements AdminDaoInterface {
    public function test()
    {
        return response()->json(['message' => 'OK from Dao']);
    }
}
