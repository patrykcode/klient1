<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of testController
 *
 * @author patryk
 */
class testController extends Controller {

    public function index() {
       
        echo 'index';
    }

    public function edit() {
        echo 'edit';
    }

    public function delete() {
        echo 'delete';
    }

    public function login() {
        if (\Auth::attempt([
                    'email' => 'patryk@redicon.pl',
                    'password' => 'haslo123'
                ])) {
            return redirect()->route('dashboard');
        }
        dd(bcrypt('haslo123'));
    }

}
