<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\ReviewLogic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected $reviewLogic;

    public function __construct(ReviewLogic $reviewLogic)
    {
        $this->reviewLogic = $reviewLogic;
    }

    public function reviews()
    {
        $user_id = Auth::id();
        $reviews = $this->reviewLogic->personal($user_id);

        return view('site.account.executor.reviews', compact('reviews'));
    }

    public function get_list(Request $request)
    {
        $result = $this->reviewLogic->get_list($request->executor_id);

        $reviews = $result['reviews'];
        $all_count = $result['all_count'];

        return response()->json(['reviews' => $reviews, 'all_count' => $all_count], 200);
    }

}
