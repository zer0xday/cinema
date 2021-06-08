<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FillPaymentMethodsTable extends Migration
{
    private const TABLE_NAME = 'payment_methods';

    private const DATA = [
        [
            'title' => 'Przelew',
        ],
        [
            'title' => 'Przy odbiorze',
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
        DB::table(self::TABLE_NAME);
        Schema::enableForeignKeyConstraints();
    }
}
