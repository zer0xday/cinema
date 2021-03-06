<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FillPlacesTable extends Migration
{
    private const TABLE_NAME = 'places';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [];

        foreach (range(1, 5) as $row) {
            foreach (range(1, 9) as $number) {
                $data[] = [
                    'row' => $row,
                    'number' => $number
                ];
            }
        }

        DB::table(self::TABLE_NAME)->insert($data);
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
