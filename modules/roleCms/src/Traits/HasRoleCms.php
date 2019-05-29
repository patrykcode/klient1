<?php

namespace Cms\Roles\Traits;

trait HasRoleCms {

    public function role() {
        return $this->belongsTo('Cms\Roles\Models\Roles', 'roles_id');
    }

    public function abilities() {
        return $this->hasMany('Cms\Roles\Models\Abilities', 'roles_id', 'roles_id');
    }

    public function isSuperAdmin() {
        return in_array($this->roles_id, config('rolecms.roles_super_admin'));
    }

    public function is($role = '') {
        return in_array($this->role->name, explode('|', $role));
    }

    public function hasAccess($action) {

        if (!config('rolecms.check_super_admin')) {
            if ($this->isSuperAdmin()) {
                return true;
            }
        }

        return (bool) $this->abilities->where('action', $action)->count();
    }

}
