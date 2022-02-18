<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $table = 'files';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'url',
		'entity',
		'item_id',
		'created_at',
		'updated_at'
	];


    public function user() {

        return $this->belongsTo( User::class,  'id', 'user_id');
    }

    public function executor() {

        return $this->belongsTo( Executor::class , 'id', 'user_id' );
    }

    public function customer() {

        return $this->belongsTo( Customer::class, 'id', 'user_id'  );
    }
}
