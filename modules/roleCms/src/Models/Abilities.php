<?php

namespace Cms\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class Abilities extends Model {

    protected $fillable = ['id', 'roles_id', 'modules','action'];
    protected $table = 'abilities';

}
