<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
    ];

    // RELATIONS

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function author(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag');
    }

    // FUNCTIONS

    public function getFormattedDate($date){
        return  Carbon::create($date)->format('d-m-Y H:i:s');
    }
}
