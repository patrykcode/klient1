<?php

namespace Cms\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository extends AbstractRepository {

    public function find($id) {
        return $this->model->with(['descOne' => function($q) {
                        $q->where('lang', $this->lang);
                    }, 'user'])->where('id', $id)->first();
    }

    public function get($column = 'pub', $val = 1) {
        return $this->model->where($column, $val)->get();
    }

    public function paginate($paginate = 15) {

        $query = $this->model;

        foreach (request()->all() as $column => $value) {
            if ($value != '--wybierz--') {
                $query = $query->where($column, $value);
            }
        }


        return $query->paginate($paginate);
    }

}
