<?php

namespace Cms\Roles\Http\Controllers;

use App\Http\Controllers\Controller;

class UsersController extends Controller {

    public $path = 'roles::';
    public $langs = [];
    public $title = '';

    public function __construct() {

        \View::composer('*', function($view) {
            $view->with('title', $this->title);
        });
    }

    public function index() {
        $this->title = 'Zarządzaj użytkownikami';

        list($users, $roles) = user()->getUsers(\Auth::user()->isSuperAdmin());

        return view($this->path . 'index', compact('users', 'roles'));
    }

    public function create(\Illuminate\Http\Request $request) {
        $new_user = false;
        if ($new_user = user()->create($request)) {
            $this->success[] = 'Dodano nowego użytkownika';
        } else {
            $this->errors[] = 'Coś poszło nie tak';
        }

        return $this->redirect(compact('new_user'));
    }

    public function delete($id) {

        if (user()->delete($id)) {
            $this->success[] = 'Usunieto użytkownika';
        } else {
            $this->errors[] = 'Coś poszło nie tak';
        }

        return $this->redirect();
    }

    public function reset($id) {
        $new_user = false;
        if ($new_user = user()->resetUserPassword($id)) {
            $this->success[] = 'Zresetowano hasło użytkownika';
        } else {
            $this->errors[] = 'Coś poszło nie tak';
        }

        return $this->redirect(compact('new_user'));
    }

    public function update(\Illuminate\Http\Request $request) {
        $errors = [];
        $success = [];
        if (user()->update($request)) {
            $success[] = 'Zapisano nowe ustawienia!';
        } else {
            $errors[] = 'Coś poszło nie tak';
        }
        return response()->json(compact('success', 'errors'));
    }

}
