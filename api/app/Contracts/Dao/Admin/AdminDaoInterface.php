<?php

namespace App\Contracts\Dao\Admin;

use Illuminate\Http\Request;

interface AdminDaoInterface {
    public function test();

    public function register(Request $request);
}
