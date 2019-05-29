<?php

namespace Cms\Articles\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model {

    protected $fillable = ['id', 'parent_id', 'img', 'imgbox', 'img_typ', 'classes', 'modules', 'menu_top', 'menu_bottom', 'menu_box', 'contact_form', 'user_id', 'pub', 'order'];
    protected $table = 'articles';

    public function user() {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    public function desc() {
        return $this->hasMany(ArticlesDescription::class);
    }

    public function descLang() {
        return $this->hasOne(ArticlesDescription::class, 'articles_id');
    }
    //usunąć
    public function descOne() {
        return $this->hasOne(ArticlesDescription::class, 'articles_id');
    }

    public function toggle($column = 'pub') {
        return $this->$column = !$this->$column;
    }

}
