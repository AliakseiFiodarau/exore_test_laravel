<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class AddColumnManagerToUsersTable extends Migration
{
    /**
     * string constant for new column name
     */
    public const MANAGER_COLUMN = 'manager';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(User::TABLE_NAME, function (Blueprint $table) {
            $table->unsignedBigInteger(self::MANAGER_COLUMN)
                ->after(User::EMAIL)
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(User::TABLE_NAME, function (Blueprint $table) {
            $table->dropColumn(self::MANAGER_COLUMN);
        });
    }
}
