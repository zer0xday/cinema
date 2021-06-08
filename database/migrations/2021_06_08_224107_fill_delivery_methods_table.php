<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FillDeliveryMethodsTable extends Migration
{
    private const TABLE_NAME = 'delivery_methods';

    private const DATA = [
        [
            'title' => 'Odbiór osobisty (na miejscu)',
            'price' => null
        ],
        [
            'title' => 'Wysyłka pocztą',
            'price' => 9.99
        ]
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table(self::TABLE_NAME)->insert(self::DATA);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        DB::table(self::TABLE_NAME)->truncate();
        Schema::enableForeignKeyConstraints();
    }
}
