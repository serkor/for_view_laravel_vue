<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appeal;
use App\Models\Bid;
use App\Models\Customer;
use App\Models\Executor;
use App\Models\Payment;
use App\Models\Review;

class DashboardController extends Controller
{

    public function index()
    {
        $appeals = Appeal::all();

        $customers = Customer::whereHas('roles', function ($role) {
            $role->where('name', 'like', 'customer');
        })->get();

        $executors = Executor::whereHas('roles', function ($role) {
            $role->where('name', 'like', 'executor');
        })->get();

        $reviews = Review::all();

        $payments = Payment::all();

        $bids = Bid::all();

        $expects = Executor::whereHas('roles', function ($role) {
            $role->where('name', 'like', 'executor');
        })->where('verified', 0)->get();

        return view('front.pages.dashboard', compact('appeals', 'customers', 'reviews', 'executors', 'payments', 'bids', 'expects'));
    }

}
