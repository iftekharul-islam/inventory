<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function invoices()
    {
    	return $this->belongsToMany('App\Invoice')->withTimestamps();
    }
    public function customers()
    {
    	return $this->belongsToMany('App\Customers')->withTimestamps();
    }
}
