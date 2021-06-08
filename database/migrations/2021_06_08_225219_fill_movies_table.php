<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FillMoviesTable extends Migration
{
    private const TABLE_NAME = 'movies';
    private const DATA = [
        [
            'title' => 'Kosmiczny Mecz 2',
            'emission_time' => '19:30:00'
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
