<?php

namespace Cms\Core\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository {

    public $langs = [];
    public $lang = 'pl';
    public $module_name = null;
    public $disc = 'public';
    protected $model;
    private static $instances = array();

    public function __construct(Model $model) {
        $this->model = $model;
        $this->module_name = $this->getName(get_class($model));
    }

    private function getName($name) {
        $explode = explode('\\', $name);

        return strtolower(end($explode));
    }

    public function setLangs($langs, $disc = null) {
        $this->langs = $langs;
        $this->disc = $disc ?? $this->disc;
        return $this;
    }

    public function setLang($lang = null) {
        $this->lang = $lang ?? $this->lang;
        return $this;
    }

    public function setDisc($disc = null) {
        $this->disc = $disc ?? $this->disc;
        return $this;
    }

    public static function getInstance(Model $model) {
        $class = get_called_class();
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static($model);
        }
        return self::$instances[$class];
    }

    public function create($data) {

        
            \DB::beginTransaction();
//            dd($data);
          
                $row = $this->model->create($data);
          
            \DB::commit();
            return $row;
       try { } catch (\PDOException $e) {
            \DB::rollback();
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return false;
    }

    public function update($id, $request) {

        $record = $this->model->find($id);

        try {
            \DB::beginTransaction();

            if (is_a($data, 'Illuminate\Support\Collection')) {
                $record->update($request->all());
            } else {
                $record->update($request);
            }

            \DB::commit();
            return $record;
        } catch (\PDOException $e) {
            \DB::rollback();
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return false;
    }

    public function delete($id) {
        try {
            if ($row = $this->find($id)) {
                files($this->disc)->deleteDir($this->module_name . '/' . $id);
                return $row->delete($id);
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    public function find($id) {
        return $this->model->find($id);
    }

    public function with($relations) {
        return $this->model->with($relations);
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel(Model $model) {
        $this->model = $model;
        return $this;
    }

}
