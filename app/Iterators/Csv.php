<?php
namespace App\Iterators;
class Csv
{
	public static function for($file, $callback)
	{
		$filepath = storage_path($file);
		$handle   = fopen($filepath, 'r');
		$headers  = [];

		while($line = fgetcsv($handle))
		{
			if(!$headers)
			{
				$headers = $line;
				continue;
			}

			$row = (object) array_combine($headers, $line);

			$callback($row);
		}
	}
}