<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('supplier');

            $table->date('first_due');

            $table->string('equipment')->nullable();

            $table->string('account_number');

            $table->string('project_nr')->nullable();

            $table->longText('memo')->nullable();

            $table->string('ship_to');

            $table->float('qty', 15, 2)->nullable();

            $table->decimal('unit_price', 15, 2)->nullable();

            $table->float('tax_rate', 15, 2)->nullable();

            $table->float('line_total', 15, 2)->nullable();

            $table->float('shipping_cost', 15, 2)->nullable();

            $table->float('discount', 15, 2)->nullable();

            $table->float('tax', 15, 2)->nullable();

            $table->float('total', 15, 2)->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
