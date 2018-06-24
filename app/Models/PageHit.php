<?php
namespace App\Models;
class PageHit extends \Illuminate\Database\Eloquent\Model
{
	public static function countLoader()
	{
		return \App\Models\PageHit::groupBy('url', 'ip')->select(
			\DB::raw('COUNT(`id`) AS `hit_count`')
			, \DB::raw('COUNT(DISTINCT `session_id`) AS `unique_hit_count`')
			, 'url'
		)
		->orderBy('url');
	}
}
