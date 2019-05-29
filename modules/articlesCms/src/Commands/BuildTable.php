<?php

namespace Cms\Articles\Commands;

use Illuminate\Console\Command;
use DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuildTable extends Command {

    protected $signature = 'articlesCms:install';

    public function handle() {

        $drop = $this->ask('Drop table if exists? (Y/N)');

        $this->info('Install [articles] table');

        if (strtolower($drop) == 'y') {
            $this->info('Drop [articles,articles_description] table');
            \Cms\Articles\Db\ArticlesDB::uninstall();
        }

        \Cms\Articles\Db\ArticlesDB::install();


        $this->info('Finished install table');
    }

}
