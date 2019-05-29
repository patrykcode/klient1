<?php

namespace Cms\Roles\Http\Controllers;

use App\Http\Controllers\Controller;

class StartController extends Controller {

    public function index() {
        return view('roles::start');
    }

}
