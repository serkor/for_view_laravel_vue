<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bids\BidStoreRequest;
use App\Http\Requests\Bids\BidUpdateRequest;
use App\Logics\Repositories\BidStatusLogic;
use App\Logics\Repositories\CustomerBidLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    protected $bidLogic;
    protected $bidStatusLogic;

    public function __construct(CustomerBidLogic $bidLogic, BidStatusLogic $bidStatusLogic)
    {
        $this->bidLogic = $bidLogic;
        $this->bidStatusLogic = $bidStatusLogic;
    }

    public function index()
    {
        $customer = Auth::user();
        $result = $this->bidLogic->index($customer);
        $cars = $result['cars'];
        $cities = $result['cities'];
        $categories = $result['categories'];
        $marks = $result['marks'];
        $mark_models = $result['mark_models'];
        $transmissions = $result['transmissions'];
        $years = $result['years'];

        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/bid.php')));

        return view('site.account.customer.bids.index',
            compact('customer', 'cars', 'cities',
                'categories', 'lang', 'marks', 'mark_models', 'transmissions',
                'years'));
    }

    public function list(Request $request)
    {
        $result = $this->bidLogic->list($request);

        return response()->json(['all_count' => $result['all_count'], 'bids' => $result['bids']]);
    }

    public function count(Request $request)
    {
        $result = $this->bidLogic->count($request);

        return response()->json([
            'open_count' => $result['open_count'],
            'confirmed_count' => $result['confirmed_count'],
            'canceled_count' => $result['canceled_count']
        ], 200);
    }

    public function store(BidStoreRequest $request)
    {
        $this->bidLogic->store($request->validated());

        return response()->json(trans('info.success'), 200);
    }

    public function show($id)
    {
        $result = $this->bidLogic->show($id);
        $bid = $result['bid'];
        $files = $result['files'];
        $statuses = $this->bidStatusLogic->all();

        $lang = collect(@include(resource_path('lang/' . App::getLocale() . '/bid.php')));

        if (Auth::id() == $bid->customer_id) {
            return view('site.account.customer.bids.show', compact('bid', 'lang', 'statuses', 'files'));
        } else {
            return redirect()->route('no_access');
        }
    }

}
