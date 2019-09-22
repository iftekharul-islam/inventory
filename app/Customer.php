<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function invoices()
    {
    	return $this->belongsToMany('App\Invoice')->withTimestamps();
    }
    public function products()
    {
    	return $this->belongsToMany('App\Product')->withTimestamps();
    }
}
