<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reminders\StoreReminderRequest;
use App\Http\Requests\Reminders\UpdateReminderRequest;
use App\Logics\Repositories\ReminderLogic;
use Illuminate\Support\Facades\Auth;

class ReminderController extends Controller
{

    protected $reminderLogic;

    public function __construct(ReminderLogic $reminderLogic)
    {
        $this->reminderLogic = $reminderLogic;
    }

    public function index()
    {
        $user_id = Auth::id();
        $reminders = $this->reminderLogic->index($user_id);

        $lang_service = $this->reminderLogic->get_language();

        return view( 'site.account.executor.calendar', compact( 'reminders', 'lang_service' ) );
    }

    public function store(StoreReminderRequest $request)
    {
        try {
            $user_id = Auth::id();
            $reminder = $this->reminderLogic->store($request->validated(), $user_id);

            return response()->json( ['reminder' => $reminder] , 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reminder not create!'], 404);
        }
    }

    public function update(UpdateReminderRequest $request)
    {
        try {
            $reminder = $this->reminderLogic->update($request->validated());

            return response()->json( ['reminder' => $reminder] , 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reminder not update!'], 404);
        }
    }
}
