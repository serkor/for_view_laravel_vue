<?php


namespace App\Logics\Repositories;


use App\Logics\Interfaces\BidStatusLogicInterface;
use App\Models\Bid;
use App\Models\BidStatus;
use App\Notifications\Customer\CustomerNewCommentBidNotification;
use App\Notifications\Executor\ExecutorNewCommentBidNotification;

class BidStatusLogic implements BidStatusLogicInterface
{
    protected $bidStatus;
    protected $bid;
    protected $bidCommentLogic;

    public function __construct(Bid $bid, BidStatus $bidStatus, BidCommentLogic $bidCommentLogic)
    {
        $this->bidStatus = $bidStatus;
        $this->bidCommentLogic = $bidCommentLogic;
        $this->bid = $bid;
    }

    public function all()
    {
        return $this->bidStatus->all();
    }

    public function list($type)
    {
        return $this->bidStatus
            ->where('role', $type)
            ->orWhere('role', NULL)
            ->get();
    }

    public function update($request, $id = null)
    {
        $bid = $this->bid->findOrFail($request['id'] ?? $id);

        $result = $bid->update([
            'status_id' => $request['status_id'],
        ]);

        if ($result) {
            if ($request['status_id'] == 1) {

                $bid->offers()->update([
                    'select' => 0,
                ]);

                $bid->update([
                    'sum_repair' => 0.00,
                    'sum_part' => 0.00,
                ]);
            }

            $comment = $this->bidCommentLogic->add($request);

            if ($bid->customer_id) {
                get_user($bid->customer_id)->notify(new CustomerNewCommentBidNotification($comment));
            }

            if ($bid->executor_id) {
                get_user($bid->executor_id)->notify(new ExecutorNewCommentBidNotification($comment));
            }

            return ['bid' => $bid->with('comments.user')->findOrFail($request['id'])];

        } else {
            return false;
        }

    }

}
