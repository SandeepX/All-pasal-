<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name','address','email','logo','ceo_id'];


    
     public function CEO(){
        return $this->belongsTo('App\Models\CEO','ceo_id');
    }
    
}
