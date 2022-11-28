<?php

namespace App\Service\Admin;

use App\Contracts\Dao\Admin\PaymentDaoInterface;
use App\Contracts\Service\Admin\PaymentServiceInterface;

class PaymentService implements PaymentServiceInterface {

    protected $paymentDaoInterface;

    public function __construct(PaymentDaoInterface $paymentDaoInterface)
    {
        $this->paymentDaoInterface = $paymentDaoInterface;
    }

    public function store($request) {
        return $this->paymentDaoInterface->store($request);
    }

    public function index()
    {
        return $this->paymentDaoInterface->index();
    }
}
