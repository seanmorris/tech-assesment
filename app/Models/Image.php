<?php
namespace App\Models;
class Image extends \Illuminate\Database\Eloquent\Model
{
	public function crop($width, $height)
	{
		return sprintf($this->croppable_url, $width, $height);
	}

	public function imageable()
    {
        return $this->morphTo();
    }
}
