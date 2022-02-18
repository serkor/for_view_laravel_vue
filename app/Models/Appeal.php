<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appeal extends Model {

    protected $table = 'appeals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'description',
        'status_id',
        'created_at',
        'updated_at'
    ];


    public function Status( $type ) {

        switch ( $type ) {
            case 0:
                echo trans( 'appeal.new' );
                break;
            case 1:
                echo trans( 'appeal.in_work' );
                break;
            case 2:
                echo trans( 'appeal.canceled' );
                break;
        }

    }

}
