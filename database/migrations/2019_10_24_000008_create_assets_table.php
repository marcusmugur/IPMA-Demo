<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');

            $table->string('serial_number')->nullable();

            $table->string('name')->nullable();

            $table->longText('notes')->nullable();

            $table->string('manufacturer')->nullable();

            $table->string('model_number')->nullable();

            $table->string('inventory_items')->nullable();

            $table->string('line')->nullable();

            $table->float('current_quantity', 15, 2)->nullable();

            $table->decimal('unit_price', 15, 2)->nullable();

            $table->string('suppliers')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
