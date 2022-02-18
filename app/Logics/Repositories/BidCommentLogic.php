<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\BidCommentLogicInterface;
use App\Models\BidComment;
use Illuminate\Support\Facades\Auth;

class BidCommentLogic implements BidCommentLogicInterface
{
    protected $bidComment;

    public function __construct(BidComment $bidComment)
    {
        $this->bidComment = $bidComment;
    }

    public function add($request)
    {
        return $this->bidComment->create([
            'bid_id' => $request['id'],
            'text' => $request['text'],
            'user_id' => Auth::id(),
            'status_id' => $request['status_id'],
            'type' => $request['type'],
        ]);
    }

    public function list($request)
    {
        return $this->bidComment
            ->where('bid_id', $request['bid_id'])
            ->where('type', 'status')
            ->with('user')
            ->get();
    }
}
