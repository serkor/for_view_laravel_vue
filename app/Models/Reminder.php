<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $table = 'reminders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'new_id',
        'type',
        'executor_id',
        'url',
        'allDay',
        'start',
        'end',
    ];

    protected $primaryKey = 'new_id';

    public $incrementing = false;

    /**
     * Determine if the model uses timestamps.
     *
     * @return bool
     */
    public function usesTimestamps()
    {
        return false;
    }

    public function user() {

        return $this->belongsTo(User::class) ;
    }
}
