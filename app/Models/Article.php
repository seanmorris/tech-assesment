<?php
namespace App\Models;
class Article
	extends    \Illuminate\Database\Eloquent\Model
	implements \App\Interfaces\Trackable
{
	public function images()
	{
		return $this->morphToMany('App\Models\Image', 'imageable');
	}

	public function trackingData()
	{
		return [
			'item_type' => 'news'
			, 'item_id' => $this->id
		];
	}
}
