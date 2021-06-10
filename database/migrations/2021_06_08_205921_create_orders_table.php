<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->references('id')->on('customers');
            $table->foreignId('payment_method_id')->references('id')->on('payment_methods');
            $table->foreignId('delivery_method_id')->references('id')->on('delivery_methods');
            $table->foreignId('movie_id')->references('id')->on('movies');
            $table->foreignId('ticket_type_id')->references('id')->on('ticket_types');
            $table->decimal('total_amount', 9);
            $table->boolean('completed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
