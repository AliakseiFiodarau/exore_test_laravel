<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRoleToUsersTable extends Migration
{

    /**
     * string constant for new column name
     */
    public const ROLE_COLUMN = 'role';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(User::TABLE_NAME, function (Blueprint $table) {
            $table->string(self::ROLE_COLUMN)
                ->after(User::NAME)
                ->default(User::ROLE_MANAGER);
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
            $table->dropColumn(self::ROLE_COLUMN);
        });
    }
}
