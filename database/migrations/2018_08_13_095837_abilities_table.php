<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AbilitiesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('abilities', function (Blueprint $table) {
            $table->unsignedInteger('roles_id')->index();
            $table->string('modules', 100);
            $table->string('action', 100);
            $table->timestamps();
        });

        Schema::table('abilities', function (Blueprint $table) {
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('abilities');
    }

}
