<?php

namespace Cms\Roles\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model {

    protected $fillable = ['id', 'name'];
    protected $table = 'roles';

    public function abilities() {
        return $this->hasMany(Abilities::class, 'roles_id', 'id');
    }

}
