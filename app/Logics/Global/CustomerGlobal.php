<?php

use App\Models\Bid;
use App\Models\BidComment;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

function check_can_review($id)
{
    if (Auth::check()) {
        $customer_bids = Bid::where('customer_id', Auth::id())
            ->where('executor_id', $id)->get();
        if (count($customer_bids) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}

function get_list_customer()
{
    return Customer::whereHas('roles', function ($role) {
        $role->where('name', 'like', 'customer');
    })->get();
}

