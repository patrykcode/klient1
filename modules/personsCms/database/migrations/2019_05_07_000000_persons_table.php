<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 150)->nullable();
            $table->string('qualifications', 500)->nullable();
            $table->string('skills', 500)->nullable();
            $table->string('langs', 500)->nullable();
            $table->integer('payments', 500)->default(0);
            $table->string('phone', 11);
            $table->string('country', 150)->nullable();
            $table->date('sdate')->nullable();
            $table->date('bdate')->nullable();
            $table->string('comments', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('persons');
    }

}
