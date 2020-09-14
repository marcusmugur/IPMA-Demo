<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('location');

            $table->string('line')->nullable();

            $table->string('model_number')->nullable();

            $table->string('part_number');

            $table->string('serial_number');

            $table->string('manufacture')->nullable();

            $table->longText('contact_manufacture')->nullable();

            $table->longText('electric_specification')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
