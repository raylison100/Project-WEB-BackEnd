<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFilesTable.
 */
class CreateFilesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('files', function(Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('original_name');
            $table->unsignedInteger('message_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('message_id')
                ->references('id')->on('messages')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('files');
    }
}
