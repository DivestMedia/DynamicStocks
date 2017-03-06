<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'user_id',
        'symbol',
        'name',
        'exchange',
        'type',
        'notes',
        'qty',
        'price',
        'account',
        'cash',
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'created_at',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
