<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\BidQuestionLogicInterface;
use App\Models\Bid;
use App\Models\BidQuestion;
use App\Notifications\Executor\ExecutorNewQuestionBidNotification;
use App\Notifications\Customer\CustomerNewQuestionBidNotification;

class BidQuestionLogic implements BidQuestionLogicInterface
{
    protected $bidQuestion;

    public function __construct(BidQuestion $bidQuestion)
    {
        $this->bidQuestion = $bidQuestion;
    }

    public function list($request)
    {
        $all_count = count($this->bidQuestion
            ->where('bid_id', $request['bid_id'])
            ->get());

        $questions = $this->bidQuestion
            ->where('bid_id', $request['bid_id'])
            ->with('customer')
            ->with('executor')
            ->paginate(9);

        return [
            'all_count' => $all_count,
            'questions' => $questions,
        ];
    }

    public function store($request)
    {
        $question = $this->bidQuestion->create($request);
        $bid = Bid::findOrFail($request['bid_id']);

        if (!empty($request['customer_id'])) {
            foreach ($bid->questions as $question) {
                if (!empty($question->executor_id)) {
                    get_user($question->executor_id)
                        ->notify(new ExecutorNewQuestionBidNotification($question));
                }
            }
        }

        if (!empty($request['executor_id'])) {
            get_user($bid->customer_id)
                ->notify(new CustomerNewQuestionBidNotification($question));
        }

    }
}
