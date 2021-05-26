<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = 
    ['username','password','email','phone','sex','city_id','district_id','ward_id','admin','status'];
    protected $table = "customers";
}
