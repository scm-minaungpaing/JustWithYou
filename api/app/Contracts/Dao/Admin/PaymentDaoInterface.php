<?php

namespace App\Contracts\Dao\Admin;

interface PaymentDaoInterface {
    public function store($request);
    public function index();
}
