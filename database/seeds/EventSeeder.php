<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
	public function run()
	{
		$parks = [];
		$teams = [];

		\App\Iterators\Csv::for('data/mlb_park_data.csv', function($row) use (&$parks){
			$parks[ $row->PARKID ] = $row;
		});

		\App\Iterators\Csv::for('data/mlb_team_data.csv', function($row) use (&$teams){
			$teams[ $row->franchise_id ] = $row;
		});

		\App\Iterators\Csv::for('data/mlb_log.csv', function($row) use ($parks, $teams){
			$article = new \App\Models\Article;

			$visitingTeam = $row->v_name;

			if(isset($teams[$row->v_name]))
			{
				$visitingTeam = $teams[$row->v_name]->nickname;
			}

			$homeTeam = $row->h_name;

			if(isset($teams[$row->h_name]))
			{
				$homeTeam = $teams[$row->h_name]->nickname;
			}

			$format = '%s at %s';

			$event = new \App\Models\Event;

			$event->title       = sprintf($format, $visitingTeam, $homeTeam);
			$event->description = '';
			$event->happened_on = sprintf(
				'%04d-%02d-%02d'
				, substr($row->date, 0, 4)
				, substr($row->date, 4, 2)
				, substr($row->date, 6, 2)
			);

			if(isset($parks[$row->park_id]))
			{
				$event->location = sprintf(
					'%s %s, %s'
					, $parks[$row->park_id]->NAME
					, $parks[$row->park_id]->CITY
					, $parks[$row->park_id]->STATE
				);
			}

			$event->save();

			printf(
				"Seeding Event: %s\n"
				, $event->title
			);
		});
	}
}
