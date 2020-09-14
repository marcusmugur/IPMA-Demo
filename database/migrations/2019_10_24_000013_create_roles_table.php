<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();

            $table->string('user_type')->nullable();

            $table->string('name')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
