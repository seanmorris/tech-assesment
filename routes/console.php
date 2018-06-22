<?php

Artisan::command('aggregate_tracking', function () {
	\App\Models\PageHit::groupBy('date', 'session_id', 'item_type')
		->select(
			DB::raw('COUNT(`id`) AS `hit_count`')
			, 'session_id'
			, 'item_type'
			, 'date'
		)
		// ->where(DB::raw('item_type IS NOT NULL'))
		->orderBy('date')
		->chunk(500, function($pageHitGroups) {
			foreach($pageHitGroups as $pageHitGroup)
			{
				$trackingSummary = \App\Models\TrackingSummary::where([
					'date'         => $pageHitGroup->date
					, 'type'       => $pageHitGroup->item_type
					, 'session_id' => $pageHitGroup->session_id
				])->first();

				if(!$trackingSummary)
				{
					$trackingSummary = new \App\Models\TrackingSummary;
				}

				var_dump($pageHitGroup->item_type);

				$trackingSummary->date       = $pageHitGroup->date;
				$trackingSummary->type       = $pageHitGroup->item_type;
				$trackingSummary->value      = $pageHitGroup->hit_count;
				$trackingSummary->session_id = $pageHitGroup->session_id;

				$trackingSummary->save();
			}
		});
})->describe('Aggregate tracking data.');
