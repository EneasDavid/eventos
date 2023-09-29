<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = ['items'=>'array'];
    protected $dates=['date'];
    public function user(){
        return $this->belongsTo('App\Models\User');
        //belonsTO = Pertecem a alguém; logo um usuario só vai poder pertencer a um evente
    }
    protected $guarded=[];
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
