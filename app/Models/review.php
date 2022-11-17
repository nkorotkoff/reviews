<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $fillable = ['title','text','rating','img','author_id','city_id'];

    public function city(){
        return $this->belongsTo(city::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'author_id');
    }

}
