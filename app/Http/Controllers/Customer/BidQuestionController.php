<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\BidQuestions\BidQuestionStoreRequest;
use App\Logics\Repositories\BidQuestionLogic;
use Illuminate\Http\Request;

class BidQuestionController extends Controller
{
    protected $bidQuestionLogic;

    public function __construct(BidQuestionLogic $bidQuestionLogic)
    {
        $this->bidQuestionLogic = $bidQuestionLogic;
    }

    public function list(Request $request)
    {
        $result = $this->bidQuestionLogic->list($request);

        return response()->json(['all_count' => $result['all_count'], 'questions' => $result['questions']]);
    }

    public function store(BidQuestionStoreRequest $request)
    {
        $this->bidQuestionLogic->store($request->validated());

        return response()->json(trans('info.success'), 200);
    }
}
