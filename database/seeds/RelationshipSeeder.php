<?php

use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
	public function run()
	{
		$imageCount = \App\Models\Image::count();
		
		\App\Models\Article::chunk(500, function($articles) use($imageCount) {
			foreach ($articles as $article)
			{
				$article->images()->attach([$article->id % $imageCount]);
			}
		});

		\App\Models\Event::chunk(500, function($events) use($imageCount) {
			foreach ($events as $event)
			{
				$event->images()->attach([$event->id % $imageCount]);
			}
		});
	}
}
