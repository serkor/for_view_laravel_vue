<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offers\OffersStoreRequest;
use App\Logics\Repositories\OfferLogic;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    protected $offerLogic;

    public function __construct(OfferLogic $offerLogic)
    {
        $this->offerLogic = $offerLogic;
    }

    public function list(Request $request)
    {
        $result = $this->offerLogic->listExecutor($request->all());

        return response()->json(['all_count' => $result['all_count'], 'offers' => $result['offers']]);
    }

    public function store(OffersStoreRequest $request)
    {
        $result = $this->offerLogic->store($request->validated());

        return response()->json($result, 200);
    }

}
