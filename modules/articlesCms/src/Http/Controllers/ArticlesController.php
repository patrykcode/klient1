<?php

namespace Cms\Articles\Http\Controllers;

use App\Repositories\Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class ArticlesController extends AdminController {

    public $path = 'articles::';
    public $size_box = [450, 300];
    public $size = [1920, 950];
    public $name_module;

    public function __construct() {
        parent::__construct();

        $this->model = articles()->setLangs($this->langs);
        $this->name_module = $this->model->module_name;

        \View::composer('*', function($view) {
            $view->with('size_box', $this->size_box);
        });
    }

    public function index() {
        $this->title = 'Zarządzaj stronami';
        ${$this->name_module} = articles()->getArticlesTree();
        $lang = articles()->langs;

        return view($this->path . 'index', compact('articles', 'lang'));
    }

    public function update(Request $request, $id, $lang = null) {
        $fileManager = files($this->disc);

        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($request->get('articles_id') == 0) {
                $row = articles()->create($request);

                $id = $row->id;
                $data['articles_id'] = $id;
            } else {
                $row = articles()->update($request->input('articles_id'), $request);
            }

            if ($request->has('img_file')) {
                $img = $fileManager->uploadFile($request->file('img_file'), $this->name_module . '/' . $row->id, [$this->size[0], $this->size[1]], [$this->size[0], null]);
                $this->success[] = 'Dodano plik: ' . $img;
            } else {
                $img = $request->input('img');
                if ($request->has('del-img')) {
                    $fileManager->delete($request->input('img'));
                    $img = '';
                    $this->success[] = 'Usunięto plik: ' . $request->input('img');
                }
            }

            if ($request->has('imgbox_file')) {
                $imgbox = $fileManager->uploadFile($request->file('imgbox_file'), $this->name_module . '/' . $row->id, [$this->size_box[0], $this->size_box[1]], [null, $this->size[1]]);
                $this->success[] = 'Dodano plik: ' . $imgbox;
            } else {
                $imgbox = $request->input('imgbox');
                if ($request->has('del-imgbox')) {
                    $fileManager->delete($request->input('imgbox'));
                    $imgbox = '';
                    $this->success[] = 'Usunięto plik: ' . $request->input('imgbox');
                }
            }

            $row->update(['imgbox' => $imgbox, 'img' => $img]);

            $this->success[] = 'Zapisano zmiany!';

            return redirect()->route('articles.update', ['id' => $id, 'lang' => $request->input("lang")])->with('success', $this->success)->withErrors($this->errors);
        } else {

            if ($id == 'n') {
                $article = articles()->makeEmpty();
            }

            if (is_numeric($id)) {

                $article = articles()->find($id, compact('lang'));
                if (is_null($article)) {
                    $this->errors[] = 'Nie znaleziono strony';
                    return $this->redirect();
                }
            }
        }



        $this->title = 'Edytuj strone';

        $articles = articles()->getArticlesTree();

        $langs = articles()->langs;

        return view($this->path . 'edit', compact('articles', 'article', 'langs'));
    }

}
