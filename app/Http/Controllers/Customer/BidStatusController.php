<?php

namespace App\Http\Controllers\Customer;

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

    public function update(BidUpdateRequest $request, $id = null)
    {
        $result = $this->bidStatusLogic->update($request->validated(), $id);

        return response()->json($result);
    }
}
