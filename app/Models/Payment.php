<?php

namespace App\Models;

use Aginev\SearchFilters\Filterable;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use Filterable;

    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_id',
        'order_id',
        'executor_id',
        'response_signature_string',
        'response_status',
        'order_status',
        'amount',
        'type',
        'package_id',
        'start',
        'finish',
        'created_at',
        'updated_at',
    ];

    public function executor() {

        return $this->belongsTo( Executor::class, 'executor_id', 'id');
    }

    public function setFilters()
    {
        $this->filter->equal('payment_id')->equal('executor_id');
    }
}
