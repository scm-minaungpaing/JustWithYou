<?php

namespace App\Service\Admin;

use App\Contracts\Dao\Admin\AdminDaoInterface;
use App\Contracts\Service\Admin\AdminServiceInterface;
use Illuminate\Http\Request;

class AdminService implements AdminServiceInterface {

    protected $adminDaoInterface;

    public function __construct(AdminDaoInterface $adminDaoInterface)
    {
        $this->adminDaoInterface = $adminDaoInterface;
    }

    public function register(Request $request)
    {
        return $this->adminDaoInterface->register($request);
    }

    public function getAllUsers()
    {
        return $this->adminDaoInterface->getAllUsers();
    }
}
