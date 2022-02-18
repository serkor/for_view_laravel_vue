<?php

namespace App\Models;

use Aginev\SearchFilters\Filterable;
use Illuminate\Database\Eloquent\Model;

class OfferTemplate extends Model
{

    use Filterable;

    protected $table = 'offer_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'executor_id',
        'sum_repair',
        'sum_part',
        'number_hours',
        'description',
        'created_at',
        'updated_at',
    ];

    public function executor(){

        return $this->belongsTo(Executor::class);
    }


    public function setFilters()
    {
        $this->filter->like('name');
    }

}
