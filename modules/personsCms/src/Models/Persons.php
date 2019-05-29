<?php

namespace Cms\Persons\Models;


class Persons extends \Cms\Core\Models\CoreModel {

    protected $fillable = ['id', 'name', 'bdate', 'qualifications', 'skills', 'langs', 'paymants', 'sdate', 'phone', 'country', 'comments'];
    protected $table = 'persons';

}
