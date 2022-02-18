<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\UpdateReviewRequest;
use App\Logics\Repositories\ReviewLogic;

class ReviewController extends Controller
{

    protected $reviewLogic;

    public function __construct(ReviewLogic $reviewLogic)
    {
        $this->reviewLogic = $reviewLogic;
    }

    public function index()
    {
        $reviews = $this->reviewLogic->index();

        return view( 'front.reviews.index', compact( 'reviews') );
    }

    public function edit($id)
    {
        $review = $this->reviewLogic->edit($id);

        return view('front.reviews.edit', compact('review'));
    }

    public function update(UpdateReviewRequest $request, $id)
    {
        $this->reviewLogic->update($request->validated(), $id);

        return redirect()->route('admin_reviews')
            ->with('status', trans('review.update'));
    }

}
