<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function customers()
    {
    	return $this->belongsToMany('App\Customers')->withTimestamps();
    }
    public function products()
    {
    	return $this->belongsToMany('App\Product')->withTimestamps();
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function favorite_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
