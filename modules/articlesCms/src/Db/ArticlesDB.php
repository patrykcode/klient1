<?php

namespace Cms\Articles\Db;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ArticlesDB {

    public static function install() {
        Schema::create('articles', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->text('img')->nullable();
            $table->text('imgbox')->nullable();
            $table->integer('img_typ')->default(0); //img,background box
            $table->text('classes')->nullable();
            $table->integer('pub')->default(1);
            $table->integer('menu_top')->default(0);
            $table->integer('menu_bottom')->default(0);
            $table->integer('menu_box')->default(0);
            $table->integer('contact_form')->default(0);
            $table->integer('user_id');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('articles_description', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('articles_id')->index()->unsigned();
            $table->text('slug')->nullable();
            $table->text('url')->nullable();
            $table->string('lang', 3);
            $table->text('name')->nullable();
            $table->text('addmission')->nullable();
            $table->text('description')->nullable();
            $table->string('meta_description', 300)->nullable();
            $table->string('meta_keywords', 160)->nullable();
            $table->timestamps();
        });

        Schema::table('articles_description', function (Blueprint $table) {
            $table->foreign('articles_id')->references('id')->on('articles')->onDelete('cascade');
        });

        Schema::create('modules', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('articles_id')->index();
            $table->string('type', 250);
            $table->text('classes')->nullable();
            $table->integer('modules_id');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::table('modules', function (Blueprint $table) {
            $table->foreign('articles_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    public static function uninstall() {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('modules');
        Schema::dropIfExists('articles_description');
        Schema::dropIfExists('articles');
    }

}
