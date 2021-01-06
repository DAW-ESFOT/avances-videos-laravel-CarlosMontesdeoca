<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected$fillable = ['title', 'body'];
    //use HasFactory;

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
