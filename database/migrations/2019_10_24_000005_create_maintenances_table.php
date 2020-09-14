<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type');

            $table->string('name');

            $table->string('location');

            $table->string('line')->nullable();

            $table->string('equipment')->nullable();

            $table->date('first_due');

            $table->string('repeats')->nullable();

            $table->date('next_due_date')->nullable();

            $table->string('assigned_to')->nullable();

            $table->boolean('is_outsourced')->default(0)->nullable();

            $table->longText('description')->nullable();

            $table->longText('qc_verification')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
