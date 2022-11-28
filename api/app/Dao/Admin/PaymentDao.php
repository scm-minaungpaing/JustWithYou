<?php

namespace App\Dao\Admin;

use App\Contracts\Dao\Admin\PaymentDaoInterface;
use App\Models\Payment;

class PaymentDao implements PaymentDaoInterface
{
    public function store($request)
    {
        info($request);
        for ($i = 1; $i < 5; $i++) {
            $type = null;
            $ph_no = null;
            if ($i == 1) {
                $type = $i;
                $ph_no = $request->kpay;
            } else if ($i == 2) {
                $type = $i;
                $ph_no = $request->wave;
            } else if ($i == 3) {
                $type = $i;
                $ph_no = $request->cbpay;
            } else if ($i == 4) {
                $type = $i;
                $ph_no = $request->ok;
            }

            Payment::updateOrCreate([
                'admin_id' => $request->admin_id,
                'type' => $type
            ], [
                'admin_id' => $request->admin_id,
                'type' => $type,
                'ph_no' => $ph_no
            ]);
        }
        return response()->json(['message' => 'OK', 'status' => 200], 200);
    }

    public function index()
    {
        $payment = Payment::get();
        return $payment;
    }
}
