<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\StoreReviewRequest;
use App\Logics\Repositories\ReviewLogic;

class ReviewController extends Controller
{
    protected $reviewLogic;

    public function __construct(ReviewLogic $reviewLogic)
    {
        $this->reviewLogic = $reviewLogic;
    }

    public function store(StoreReviewRequest $request)
    {
        $result = $this->reviewLogic->store($request->validated());

        $count = $result['count'];
        $review = $result['review'];

        return response()->json(['count' => $count, 'review' => $review], 200);
    }

}
