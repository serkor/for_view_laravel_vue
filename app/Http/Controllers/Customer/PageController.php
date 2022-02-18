<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\OrderService;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function help()
    {
        return view('site.account.customer.help');
    }

    public function settings()
    {
        $customer = Auth::user();

        return view('site.account.customer.settings', compact('customer'));
    }

}
