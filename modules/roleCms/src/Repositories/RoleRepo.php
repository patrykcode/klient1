<?php

namespace Cms\Roles\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class RoleRepo extends \Cms\Core\Repositories\Repository {

    public $premissions;
    public $role;
    public $abilities;

    public function update($id, $request) {

        try {
            \DB::beginTransaction();
            $id = $request->input('id');
            $role = $this->find($id);
            if ($role->abilities->isNotEmpty()) {
                $role->abilities()->delete();
            }
            if ($request->has('premissions')) {
                foreach ($request->input('premissions') as $modules => $abilities) {
                    foreach ($abilities as $action => $on) {
                        $role->abilities()->create(['roles_id' => $id, 'modules' => $modules, 'action' => $modules . '.' . $action]);
                    }
                }
            }
            $role->update($request->only('name'));
            \DB::commit();
            return $role;
        } catch (\PDOException $e) {
            \DB::rollback();
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return false;
    }

    public function find($id) {
        return $this->model->find($id);
    }

    public function getPremissions($id) {

        return $this->model->find($id)->abilities;
    }

}
