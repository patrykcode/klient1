<?php

namespace Cms\Roles\Models;

class Roles extends \Cms\Core\Models\CoreModel {

    protected $fillable = ['id', 'name'];
    protected $table = 'roles';

    public function abilities() {
        return $this->hasMany(Abilities::class, 'roles_id', 'id');
    }

}
