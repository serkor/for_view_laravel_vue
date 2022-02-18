<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\ReviewLogicInterface;
use App\Models\Executor;
use App\Models\Review;
use App\Notifications\Executor\ExecutorNewReviewNotification;
use Illuminate\Support\Facades\Auth;

class ReviewLogic implements ReviewLogicInterface
{
    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function index()
    {
        return $this->review->all();
    }

    public function personal($user_id)
    {
        return $this->review
            ->where('executor_id', $user_id)
            ->where('public', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function get_list($id)
    {
        $all_count = count($this->review
            ->where('executor_id', $id)
            ->where('public', 1)
            ->orderBy('created_at', 'DESC')
            ->get());

        $reviews = $this->review
            ->with('customer')
            ->where('executor_id', $id)
            ->where('public', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return ['all_count' => $all_count, 'reviews' => $reviews];
    }

    public function store($request)
    {
        $review = new Review();
        $review->description = $request['description'];
        $review->executor_id = $request['executor_id'];
        $review->rate = $request['rate'];
        $review->customer_id = Auth::id();
        $review->save();

        get_user($review->executor_id)->notify(new ExecutorNewReviewNotification($review));

        $this->count_rate($review);
        $count = count($this->review->where('executor_id', $review->executor_id)->get());

        return ['review' => $review, 'count' => $count];
    }

    public function edit($id)
    {
        return $this->review->findOrFail($id);
    }

    public function update($request, $id)
    {
        $review = $this->review->findOrFail($id);
        $review->description = $request['description'];
        $review->public = $request['public'];
        $review->save();
    }

    public function count_rate($review)
    {
        $count_reviews = count($this->review->where('executor_id', $review->executor_id)->get());

        $count_stars = $this->review->where('executor_id', $review->executor_id)->sum('rate');

        $new_rate = $count_stars / $count_reviews;

        Executor::where('id', $review->executor_id)
            ->update(['rate' => $new_rate]);
    }

}
