<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_places', function (Blueprint $table) {
            $table->foreignId('customer_id')
                ->references('id')
                ->on('customers')
                ->cascadeOnDelete();
            $table->foreignId('place_id')
                ->references('id')
                ->on('places'
                )->cascadeOnDelete();
            $table->primary(['customer_id', 'place_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers_places');
    }
}
