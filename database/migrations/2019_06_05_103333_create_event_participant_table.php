<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_participant', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('participant_id')->unsigned()->index();
            $table->unsignedInteger('event_id')->unsigned()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('participant_id')
                ->references('id')->on('participants')->onDelete("cascade");
            $table->foreign('event_id')
                ->references('id')->on('events')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('event_participants');
    }
}
