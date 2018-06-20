<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
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

			$winningTeam = $row->v_name;

			if($row->v_score < $row->h_score)
			{
				$winningTeam = $row->v_name;
			}

			$format = '%4$s win at %3$s';

			if($row->winning_pitcher_name)
			{
				$format = '%2$s (%4$s) throws winning pitch at %3$s';
			}

			if($row->attendance && $row->winning_pitcher_name)
			{
				$format = '%1$s in attendance as %2$s (%4$s) throws winning pitch at %3$s';
			}

			$park = $row->park_id;

			if(isset($parks[$row->park_id]))
			{
				$park = $parks[$row->park_id]->NAME;
			}

			if(isset($teams[$winningTeam]))
			{
				$winningTeam = $teams[$winningTeam]->nickname;
			}

			$article->title = sprintf(
				$format
				, number_format((int)$row->attendance, 0, '.', ',')
				, $row->winning_pitcher_name
				, $park
				, $winningTeam
			);

			$article->body = '';

			$article->happened_on = sprintf(
				'%04d-%02d-%02d'
				, substr($row->date, 0, 4)
				, substr($row->date, 4, 2)
				, substr($row->date, 6, 2)
			);

			printf(
				"Seeding Article: %s: %s\n"
				, $article->happened_on
				, $article->title
			);

			$article->save();
		});
	}
}
