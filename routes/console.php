<?php

Artisan::command('aggregate_tracking', function () {
	\App\Models\PageHit::groupBy('date', 'session_id', 'item_type')->select(
		DB::raw('COUNT(`id`) AS `hit_count`')
		, 'session_id'
		, 'item_type'
		, 'date'
	)
	->orderBy('date')
	->chunk(500, function($pageHitGroups) {
		foreach($pageHitGroups as $pageHitGroup)
		{
			$type = 'website_views';

			if($pageHitGroup->item_type)
			{
				$type = $pageHitGroup->item_type . '_views';
			}

			$trackingSummary = \App\Models\TrackingSummary::where([
				'date'         => $pageHitGroup->date
				, 'session_id' => $pageHitGroup->session_id
				, 'type'       => $type
			])->first();

			if(!$trackingSummary)
			{
				$trackingSummary = new \App\Models\TrackingSummary;
			}

			$trackingSummary->date       = $pageHitGroup->date;
			$trackingSummary->session_id = $pageHitGroup->session_id;
			$trackingSummary->type       = $type;
			$trackingSummary->value      = $pageHitGroup->hit_count;

			$trackingSummary->save();
		}
	});
})->describe('Aggregate tracking data.');
