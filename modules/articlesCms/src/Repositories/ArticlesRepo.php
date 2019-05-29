<?php

namespace Cms\Articles\Repositories;

use Illuminate\Support\Facades\DB;

class ArticlesRepo extends \Cms\Core\Repositories\Repository {

    public function makeEmpty() {
        $article = new \Cms\Articles\Models\Articles();
        $article->parent_id = 0;
        $article->id = 'n';
//        $article = $article->descOne();

        return $article;
    }

    public function getArticlesTree($parent_id = 0) {
        try {
            return $this->getModel()->where('parent_id', $parent_id)->with('desc')->orderBy('order')->get()->transform(function($row) {
                        $row->child = $row->where('parent_id', $row->id)->with('desc')->orderBy('order')->get()->transform(function($row_child) {
                            $row_child->child = $row_child->where('parent_id', $row_child->id)->with('desc')->orderBy('order')->get();
                            return $row_child;
                        });
                        return $row;
                    });
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    public function getArticlesMenu($parent_id = 1, $menu_typ = 'top', $lang = 'pl') {
        $this->lang = $lang;
        $typ = 'menu_' . $menu_typ;
        return $this->model->where([['parent_id', $parent_id], [$typ, 1], ['pub', 1]])->with(['description' => function($q) use($typ) {
                        $q->where('lang', $this->lang);
                    }])->orderBy('order')->get()->transform(function($row) use($typ) {
                    $row->child = $row->where([['parent_id', $row->id], [$typ, 1], ['pub', 1]])->with(['description' => function($q) use($typ) {
                                    $q->where('lang', $this->lang);
                                }])->orderBy('order')->get()->transform(function($row_child) use($typ) {
                        $row_child->child = $row_child->where([['parent_id', $row_child->id], [$typ, 1], ['pub', 1]])->with(['description' => function($q) {
                                        $q->where('lang', $this->lang);
                                    }])->orderBy('order')->get();
                        return $row_child;
                    });
                    return $row;
                });
    }

    public function create($request) {
        $data = $request->toArray();

        try {
            \DB::beginTransaction();

            $record = $this->model->create([
                'user_id' => \Auth::user()->id,
            ]);

            $data['menu_top'] = (int) $request->has('menu_top');
            $data['menu_bottom'] = (int) $request->has('menu_bottom');
            $data['menu_box'] = (int) $request->has('menu_box');

            $record->fill($data)->save();

            $desc = $request->only(['slug', 'url', 'addmission', 'description', 'meta_description', 'meta_keywords']);
            $desc['name'] = $request->get('name', $record->id);

            foreach ($this->langs as $lang) {
                $desc['lang'] = $lang->code;
                $desc[$this->module_name . '_id'] = $record->id;
                $desc['slug'] = seoUrl($lang->code . '/' . $desc['name']);
                $d = $record->desc()->create($desc);
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

    public function update($id, $request) {

        $data = $request->toArray();
        try {
            \DB::beginTransaction();

            $record = $this->model->find($id);

            if ($request->has('order')) {

                $record->fill($data)->save();
            } else {
                $data['menu_top'] = (int) $request->has('menu_top');
                $data['menu_bottom'] = (int) $request->has('menu_bottom');
                $data['menu_box'] = (int) $request->has('menu_box');

                $record->fill($data)->save();

                $desc = $request->only(['slug', 'url', 'addmission', 'description', 'meta_description', 'meta_keywords']);
                $desc['name'] = $request->get('name', $record->id);

                $record2 = $record->descLang()->where('lang', $request->get('lang'))->first();

                $record2->fill($desc)->save();
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

    public function find($id, $helper = []) {
        return $this->model->with(['descLang' => function($q) use($helper) {
                        $q->where('lang', $helper['lang']??'!=""');
                    }, 'user'])->where('id', $id)->first();
    }

    public function checkUrl($request) {
        if ($request->input('articles_id') == 1) {
            return '/';
        }
//  TODO robienie urla
        return seoUrl($request->input('lang') . '/' . $request->input('articles_id') . '-' . $request->input('name'));
    }

}
