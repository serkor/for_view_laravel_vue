<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\PaymentLogic;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentLogic;

    public function __construct(PaymentLogic $paymentLogic)
    {
        $this->paymentLogic = $paymentLogic;
    }

    public function all()
    {
        $result = $this->paymentLogic->all();

        $payments = $result['payments'];

        return view('front.payments.index', compact('payments'));
    }

    public function search(Request $request)
    {
        $filter = \Request::input('filter', [
            'payment_id' => $request['payment_id'] ?? null,
            'executor_id' => $request['executor_id'] ?? null,
        ]);

        $payments = Payment::orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(20);

        return view('front.payments.index', compact('payments'));
    }

}
