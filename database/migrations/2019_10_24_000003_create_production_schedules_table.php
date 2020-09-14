<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('production_schedules', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->longText('production_description')->nullable();

            $table->string('room');

            $table->string('line');

            $table->datetime('start_time');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
