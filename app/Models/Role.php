<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	protected $table = 'roles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description'
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

	public function users() {

		return $this->belongsToMany( User::class, 'role_user' );
	}

    public function customers() {

        return $this->belongsToMany( User::class, 'role_user', 'role_id', 'user_id');
    }

    public function executors() {

        return $this->belongsToMany( User::class, 'role_user', 'role_id', 'user_id');
    }
}
