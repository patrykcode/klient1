<?php

namespace Cms\Persons\Models;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model {

    protected $fillable = ['id', 'name', 'bdate', 'qualifications', 'skills', 'langs', 'paymants', 'sdate', 'phone', 'country', 'comments'];
    protected $table = 'persons';

}
