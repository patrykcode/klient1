<?php

namespace Cms\Articles\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesDescription extends Model {

    protected $fillable = ['id', 'articles_id', 'slug', 'url', 'lang', 'name', 'addmission', 'description', 'meta_description', 'meta_keywords'];
    protected $table = 'articles_description';

    public function articles() {
        return $this->hasOne(Articles::class, 'id', 'articles_id');
    }

}
