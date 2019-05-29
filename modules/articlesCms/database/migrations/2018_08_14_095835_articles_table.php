<?php


use Illuminate\Database\Migrations\Migration;

class ArticlesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \Cms\Articles\Db\ArticlesDB::install();
    }

    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        \Cms\Articles\Db\ArticlesDB::uninstall();
    }

   

}
