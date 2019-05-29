<?php

namespace Cms\Articles\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller {

    public $path = 'articles::front.';

    public function index(Request $request) {

        $langs = \Cms\Core\Models\Langs::where('pub', 1)->get();
        $lang = 'pl';
        $article1 = articles()->setLangs($langs)->find(1, compact('lang'));
        $article2 = articles()->find(2, compact('lang'));

        return view($this->path . 'index', compact('article1', 'article2', 'lang'));
    }

    public function update(\Cms\Articles\Request\PersonsRequest $request) {

        //TODO walicadja request
        if ($request->isMethod('post')) {

            if ($row = persons()->create($request->all())) {
                $this->success[] = "Dziękujemy zapisano zgloszenie.";
            } else {
                $this->errors[] = "Ups coś poszło nie tak!";
            }
        }

        return $this->redirect();
    }

}
