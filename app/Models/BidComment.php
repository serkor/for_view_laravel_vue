<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidComment extends Model
{
    protected $table = 'bid_comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bid_id',
        'status_id',
        'text',
        'user_id',
        'type',
        'created_at',
    ];

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function status()
    {
        return $this->belongsTo(BidStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
