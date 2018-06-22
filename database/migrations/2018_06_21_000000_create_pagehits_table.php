<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageHitsTable extends Migration
{
	
	public function up()
	{
		Schema::create('page_hits', function (Blueprint $table) {
			$table->increments('id');

			$table->string('url');

			$table->string('item_type')
				->nullable();

			$table->unsignedInteger('item_id')
				->nullable();

			$table->string('ip');

			$table->string('email')
				->nullable();

			$table->string('marketing_tracking_code')
				->nullable();

			$table->string('session_id');

			$table->timestamps();

			$table->date('date')->storedAs('DATE(`created_at`)');

			$table->index('date');
			$table->index('session_id');
			
			$table->index('item_type')
				->nullable();

			$table->index('url');
		});
		Schema::create('tracking_summaries', function (Blueprint $table) {
			$table->increments('id');
			$table->date('date');
			$table->string('type')
				->nullable();
			$table->string('session_id');
			$table->unsignedInteger('value');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('page_hits');
		Schema::dropIfExists('tracking_summaries');
	}
}
