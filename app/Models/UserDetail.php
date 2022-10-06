<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'year_of_birth',
        'address'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
