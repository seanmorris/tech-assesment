<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
	
	public function up()
	{
		Schema::create('images', function (Blueprint $table) {
			$table->increments('id');
			$table->string('original_url');
			$table->string('croppable_url');
			$table->timestamps();
		});

		Schema::create('imageables', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('image_id');
			$table->unsignedInteger('imageable_id');
			$table->string('imageable_type');
		});
	}

	public function down()
	{
		Schema::dropIfExists('images');
		Schema::dropIfExists('imageables');
	}
}
