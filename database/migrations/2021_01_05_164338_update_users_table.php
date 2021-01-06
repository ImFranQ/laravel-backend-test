<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'firstname');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname', 100)->change();
            $table->string('lastname', 100);
            $table->string('phone', 11);
            $table->string('dni', 11);
            $table->date('birthdate');
            $table->unsignedBigInteger('municipality_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('firstname', 'name');
        });
    }
}
