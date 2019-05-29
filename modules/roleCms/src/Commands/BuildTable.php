<?php

namespace Cms\Roles\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuildTable extends Command {

    protected $signature = 'roleCms:install';

    public function handle() {

        $drop = $this->ask('Drop table if exists? (Y/N)');

        $this->info('Install [roles, abilities] table');

        if (strtolower($drop) == 'y') {
            $this->info('Drop action_log table');
            Schema::disableForeignKeyConstraints();

            Schema::dropIfExists('roles');
            Schema::dropIfExists('abilities');
        }


        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('abilities', function (Blueprint $table) {
            $table->unsignedInteger('roles_id')->index();
            $table->string('modules', 100);
            $table->string('action', 100);
            $table->timestamps();
        });

        Schema::table('abilities', function (Blueprint $table) {
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');
        });


        $this->info('Finished install table');
    }

}
