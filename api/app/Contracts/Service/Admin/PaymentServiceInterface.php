<?php

namespace App\Contracts\Service\Admin;

interface PaymentServiceInterface {
    public function store($request);
    public function index();
}
