<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Logics\Repositories\MessageLogic;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $messageLogic;

    public function __construct(MessageLogic $messageLogic)
    {
        $this->messageLogic = $messageLogic;
    }

    public function store(Request $request)
    {

        $this->messageLogic->store($request->all());

        return response()->json(trans('info.message_success'), 200);
    }
}
