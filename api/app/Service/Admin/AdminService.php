<?php

namespace App\Service\Admin;

use App\Contracts\Dao\Admin\AdminDaoInterface;
use App\Contracts\Service\Admin\AdminServiceInterface;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminService implements AdminServiceInterface {

    protected $adminDaoInterface;

    public function __construct(AdminDaoInterface $adminDaoInterface)
    {
        $this->adminDaoInterface = $adminDaoInterface;
    }

    public function test()
    {
        $test = $this->adminDaoInterface->test();

        $admin = Admin::find(1);

        return $admin;
    }

    public function register(Request $request)
    {
        return $this->adminDaoInterface->register($request);
    }
}
