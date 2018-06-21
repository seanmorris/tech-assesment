<?php

use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
	public function run()
	{
		$imageCount = 1085;
		
		\App\Models\Article::chunk(500, function($articles) use($imageCount) {
			foreach ($articles as $article)
			{
				$article->images()->attach([$article->id % $imageCount]);
			}
		});
	}
}
