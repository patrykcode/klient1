<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $success = [];
    public $errors = [];
    public $langs = [];

    public function __construct() {
        $this->langs = [];
    }

    public function redirect($data = []) {
        return redirect()->back()->with($data)->with('success', $this->success)->withErrors($this->errors);
    }

}
