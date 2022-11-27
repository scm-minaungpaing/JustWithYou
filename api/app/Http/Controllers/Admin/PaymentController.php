<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Service\Admin\PaymentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStoreRequest;

class PaymentController extends Controller
{
    protected $paymentServiceInterface;

    public function __construct(PaymentServiceInterface $paymentServiceInterface)
    {
        $this->paymentServiceInterface = $paymentServiceInterface;
    }

    public function store(PaymentStoreRequest $request) {
        return $this->paymentServiceInterface->store($request);
    }

    public function index() {
        $response = $this->paymentServiceInterface->index();
        return response()->json(['data' => $response ], 200);
    }
}
