<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FillTicketTypesTable extends Migration
{
    private const TABLE_NAME = 'ticket_types';
    private const DATA = [
        [
            'title' => 'Normalny',
            'price' => 19.90
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
        DB::table(self::TABLE_NAME)->truncate();
    }
}
