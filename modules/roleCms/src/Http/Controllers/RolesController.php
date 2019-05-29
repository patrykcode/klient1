<?php

namespace Cms\Roles\Http\Controllers;

use App\Http\Controllers\Controller;

class RolesController extends Controller {

    public $path = 'roles::';
    public $langs = [];
    public $title = '';

    public function create(\Illuminate\Http\Request $request) {

        if (roles()->create($request->toArray())) {
            $this->success[] = 'Dodano nową role!';
        } else {
            $this->errors[] = 'Coś poszło nie tak';
        }

        return $this->redirect();
    }

    public function show(\Illuminate\Http\Request $request, $id) {
        $role = roles()->find($id);
        $premissions = roles()->getPremissions($id);

        return view($this->path . 'edit', compact('role', 'premissions'));
    }

    public function update(\Illuminate\Http\Request $request) {

        if (roles()->update($request->input('id'), $request)) {
            $this->success[] = 'Zapisano nowe ustawienia!';
        } else {
            $this->errors[] = 'Coś poszło nie tak';
        }


        return $this->redirect();
    }

}
