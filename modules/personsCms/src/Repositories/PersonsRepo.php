<?php

namespace Cms\Persons\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class PersonsRepo extends \Cms\Core\Repositories\Repository {

    public function getCountry() {
        return $this->model->select('country')->groupBy('country')->get();
    }
    public function getQualifications() {
        return $this->model->select('qualifications')->groupBy('qualifications')->get();
    }

}
