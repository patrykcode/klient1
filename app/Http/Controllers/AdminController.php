<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public $success = [];
    public $errors = [];
    public $langs = [];
    public $model = null;
    public $name_module = null;
    public $size = [1920, 450];
    public $disc = 'public';

    public function __construct() {
        $this->langs = \Cms\Core\Models\Langs::where('pub', 1)->get();
        \View::composer('*', function($view) {
            $view->with('name_module', $this->name_module);
            $view->with('size', $this->size);
            $view->with('disc', $this->disc);
        });
    }

    public function redirect($data = []) {
        return redirect()->back()->with($data)->with('success', $this->success)->withErrors($this->errors);
    }

    public function pub($id) {
        if ($row = $this->model->find($id)) {
            $row->toggle();
            $row->save();
            $this->success[] = 'Zmieniono status!';
        }
        return $this->redirect();
    }

    public function order(\Illuminate\Http\Request $request) {

        foreach ($request->input('order') as $id => $order) {

            $this->model->update($id, collect(['order' => $order]));
        }

        return redirect()->back()->with('success', ['Kolejność zmieniona']);
    }

    public function delete($id) {

        if ($row = $this->model->delete($id)) {
            $this->success[] = 'Usunięto pozycje!';
        } else {
            $this->errors[] = 'Nie udało się usunąć pozycji!';
        }

        return $this->redirect();
    }

}
