<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Cms\Core\Models;
use Illuminate\Database\Eloquent\Model;

class CoreModel extends Model{
    
    public function getFillable(){
        return $this->fillable;
    }
}
