<?php
namespace App\Models;
class Event extends \Illuminate\Database\Eloquent\Model
{
	public function images()
    {
        return $this->morphToMany('App\Models\Image', 'imageable');
    }
}
