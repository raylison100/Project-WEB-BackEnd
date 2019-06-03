<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatusEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();

        });

        $this->seed();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('status_events');
    }

    public function seed()
    {
        $datas = [
            [
                'name' => 'CREATED',
            ],
            [
                'name' => 'ACCOMPLISHED',
            ],
            [
                'name' => 'CANCELED',
            ]
        ];

        foreach ($datas as $data) {
            \App\Models\StatusEvent::create($data);
        }

    }
}
