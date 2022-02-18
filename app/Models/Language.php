<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

	protected $table = 'languages';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'locate_code',
		'name',
		'script',
		'native',
		'regional',
		'default'
	];

    /**
     * Determine if the model uses timestamps.
     *
     * @return bool
     */
    public function usesTimestamps()
    {
        return false;
    }

}
