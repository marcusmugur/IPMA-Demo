<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetPurchaseOrderPivotTable extends Migration
{
    public function up()
    {
        Schema::create('asset_purchase_order', function (Blueprint $table) {
            $table->unsignedInteger('purchase_order_id');

            $table->foreign('purchase_order_id', 'purchase_order_id_fk_501781')->references('id')->on('purchase_orders')->onDelete('cascade');

            $table->unsignedInteger('asset_id');

            $table->foreign('asset_id', 'asset_id_fk_501781')->references('id')->on('assets')->onDelete('cascade');
        });
    }
}
