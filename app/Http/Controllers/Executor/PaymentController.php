<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\PaymentLogic;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $paymentLogic;

    public function __construct(PaymentLogic $paymentLogic)
    {
        $this->paymentLogic = $paymentLogic;
    }

    public function payments()
    {
        $executor = Auth::user();
        $result = $this->paymentLogic->index($executor->id);

        $payments = $result['payments'];
        $pro_payment = $result['pro_payment'];

        return view('site.account.executor.payments', compact('payments', 'executor', 'pro_payment'));
    }

    public function responseurl()
    {
       $this->paymentLogic->responseurl();

       return redirect()->route('thanks');
    }

    public function callbackurl()
    {
        return redirect()->route('executor_payments');
    }

    public function thanks()
    {
        return view('site.account.executor.thanks');
    }

}
