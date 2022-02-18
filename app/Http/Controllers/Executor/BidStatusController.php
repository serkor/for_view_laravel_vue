<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bids\BidUpdateRequest;
use App\Logics\Repositories\BidStatusLogic;
use Illuminate\Http\Request;

class BidStatusController extends Controller
{
    protected $bidStatusLogic;

    public function __construct(BidStatusLogic $bidStatusLogic)
    {
        $this->bidStatusLogic = $bidStatusLogic;
    }

    public function list(Request $request)
    {
        $result = $this->bidStatusLogic->list($request['type']);

        return response()->json($result);
    }

    public function update(BidUpdateRequest $request)
    {
        $result = $this->bidStatusLogic->update($request->validated());

        return response()->json($result);
    }
}
