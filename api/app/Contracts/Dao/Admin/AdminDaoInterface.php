<?php

namespace App\Contracts\Dao\Admin;

use Illuminate\Http\Request;

interface AdminDaoInterface {
    public function register(Request $request);
    public function getAllUsers();
}
