<?php

namespace Cms\Roles\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepo extends \Cms\Core\Repositories\Repository {

    public $premissions;
    public $role;
    public $abilities;

    public function create($request) {
        $param = $request->all();

        try {
            $param['haslo'] = str_random(8);
            $param['password'] = \Hash::make($param['haslo']);
            $row = $this->model->create($param);
            if ($row) {
                $row->haslo = $param['haslo'];
//                \Mail::send('email.register', $row->toarray(), function($message) use($row) {
//                    $message->subject('Rejestracja konta');
//                    $message->to($row->email);
//                });
            }

            return $row;
        } catch (\PDOException $e) {
            \DB::rollback();
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return false;
    }

    public function getUsers($withOutAdmin = true) {
        try {
            if (!$withOutAdmin) {
                $users = $this->model->where('roles_id', '!=', 1)->get();

                $roles = \Cms\Roles\Models\Roles::where('id', '!=', 1)->get();
            } else {
                $users = $this->model->get();
                $roles = \Cms\Roles\Models\Roles::get();
            }
            return [$users, $roles];
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }

    public function getUser($id = 1) {
        try {
            return $this->model->find($id);
        } catch (\PDOException $e) {
            \DB::rollback();
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return false;
    }

    public function update($id, $request) {
        try {
            $user = $this->model->find($id);
            if ($user) {
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->roles_id = $request->input('roles');
                $user->save();
            }
            \DB::commit();
            return $user;
        } catch (\PDOException $e) {
            \DB::rollback();
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return false;
    }

    public function resetUserPassword($id) {
        try {
            $user = $this->model->find($id);
            if ($user) {
                $pass = str_random(8);
                $user->password = \Hash::make($pass);
                $user->save();

                $user->haslo = $pass;
//                \Mail::send('email.register', $user->toarray(), function($message) use($user) {
//                    $message->subject('Nowe hasło - resetowanie');
//                    $message->to($user->email);
//                });
            }
            \DB::commit();
            return $user;
        } catch (\PDOException $e) {
            \DB::rollback();
        } catch (\Exception $e) {
            \DB::rollback();
        }
        return false;
    }

}
