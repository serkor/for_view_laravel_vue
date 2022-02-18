<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bids\BidUpdateRequest;
use App\Logics\Repositories\BidLogic;
use App\Logics\Repositories\BidStatusLogic;
use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{
    protected $bidLogic;
    protected $bidStatusLogic;

    public function __construct(BidLogic $bidLogic, BidStatusLogic $bidStatusLogic)
    {
        $this->bidLogic = $bidLogic;
        $this->bidStatusLogic = $bidStatusLogic;
    }

    public function index()
    {
        $bids = $this->bidLogic->all();

        return view('front.bids.index', compact( 'bids' ));
    }

    public function show($id)
    {
        $result = $this->bidLogic->show($id);
        $bid = $result['bid'];

        return view('front.bids.show', compact('bid'));
    }

    public function update(BidUpdateRequest $request)
    {
        $result = $this->bidLogic->update($request->validated());

        return response()->json($result);
    }

    public function search(Request $request)
    {
        $filter = \Request::input('filter', [
            'id' => $request['id'] ?? null,
        ]);

        $bids = Bid::orderBy('id', 'desc')
            ->filter($filter)
            ->paginate(20);

        return view('front.bids.index', compact('bids'));
    }
}
