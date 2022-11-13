<?php

namespace App\Contracts\Service\Admin;

use Illuminate\Http\Request;

interface AdminServiceInterface {
    public function test();

    public function register(Request $request);
}
