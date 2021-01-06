<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    //use HasFactory;
    protected $fillable = ['text'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function article(){
        return $this->belongsTo('App\Models\Article');
    }

}
