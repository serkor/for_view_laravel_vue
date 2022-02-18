<?php


namespace App\Logics\Repositories;

use App\Logics\Interfaces\ReminderLogicInterface;
use App\Models\Reminder;
use Illuminate\Support\Facades\App;


class ReminderLogic implements ReminderLogicInterface
{
    protected $reminder;

    public function __construct(Reminder $reminder){

        $this->reminder = $reminder;
    }

    public function index($user_id){

        return $this->reminder->where( 'executor_id', $user_id )->get();
    }

    public function store($request, $user_id){

        $this->reminder->new_id = $request['reminder']['new_id'];
        $this->reminder->type = $request['reminder']['type'];
        $this->reminder->title = $request['reminder']['title'];
        $this->reminder->url = $request['reminder']['url'];
        $this->reminder->start = $request['reminder']['start'];
        $this->reminder->end = $request['reminder']['end'];
        $this->reminder->allDay = $request['reminder']['allDay'];
        $this->reminder->executor_id = $user_id;
        $this->reminder->save();

        return $this->reminder;
    }

    public function store_in_order($request){

        $this->reminder->new_id = $request['reminder']['new_id'];
        $this->reminder->type = $request['reminder']['type'];
        $this->reminder->title = $request['reminder']['title'];
        $this->reminder->url = $request['reminder']['url'];
        $this->reminder->start = $request['reminder']['start'];
        $this->reminder->end = $request['reminder']['end'];
        $this->reminder->allDay = $request['reminder']['allDay'];
        $this->reminder->executor_id = $request['reminder']['executor_id'];
        $this->reminder->save();

        return $this->reminder;
    }

    public function update($request){

        $this->reminder->findOrFail($request['reminder']['new_id'])->update([
            'start' => $request['reminder']['start'],
            'end' => $request['reminder']['end'],
        ]);

        return $this->reminder;
    }

    public function get_language(){

        $default_lang = App::getLocale();
        $lang = @include_once(resource_path("lang/$default_lang/reminders.php"));
        $lang_service = collect($lang);

        return $lang_service;
    }

}
