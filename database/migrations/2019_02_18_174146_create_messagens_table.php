<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateMessagensTable.
 */
class CreateMessagensTable extends Migration
{
	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('content');
            $table->unsignedInteger('user_id')->nullable(false);
            $table->unsignedInteger('event_id')->nullable(false);
            $table->unsignedInteger('user_type_id')->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('event_id')
                ->references('id')->on('events')
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
        Schema::drop('messages');
    }
}
