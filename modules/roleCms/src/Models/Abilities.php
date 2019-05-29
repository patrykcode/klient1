<?php

namespace Cms\Roles\Models;

class Abilities extends \Cms\Core\Models\CoreModel {

    protected $fillable = ['id', 'roles_id', 'modules','action'];
    protected $table = 'abilities';

}
