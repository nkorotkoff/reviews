<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    protected $fillable = ['name'];
    public function review(){
       return $this->hasMany(review::class,'city_id');
    }
}
