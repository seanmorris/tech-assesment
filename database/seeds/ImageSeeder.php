<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
	public function run()
	{
		foreach(range(0, 1084) as $imageId)
		{
			$image = new \App\Models\Image;

			$image->croppable_url = sprintf(
				'https://picsum.photos/%%d/%%d?image=%d'
				, $imageId
			);

			$image->original_url = sprintf(
				$image->croppable_url
				, 0
				, 0
			);

			$image->save();
		}
	}
}
