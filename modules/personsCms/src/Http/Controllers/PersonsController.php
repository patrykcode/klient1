<?php

namespace Cms\Persons\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class PersonsController extends AdminController {

    public $path = 'persons::';
    public $name_module;

    public function __construct() {
        parent::__construct();

        $this->model = persons()->setLangs($this->langs);
        $this->name_module = $this->model->module_name;
    }

    public function index() {
        $this->title = 'Lista zgłoszeń';
        $rows = persons()->paginate();
        $countries = persons()->getCountry();
        $qualifications = persons()->getQualifications();

        return view($this->path . 'index', compact('rows', 'countries', 'qualifications'));
    }

}
