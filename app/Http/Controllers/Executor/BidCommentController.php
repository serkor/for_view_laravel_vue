<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\BidCommentLogic;
use Illuminate\Http\Request;

class BidCommentController extends Controller
{

    protected $bidCommentLogic;

    public function __construct(BidCommentLogic $bidCommentLogic)
    {
        $this->bidCommentLogic = $bidCommentLogic;
    }

    public function add(Request $request)
    {
        $this->bidCommentLogic->add($request->all());
    }

    public function list(Request $request)
    {
       $result = $this->bidCommentLogic->list($request->all());

        return response()->json($result);

    }

}
