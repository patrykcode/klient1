<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $users = ['patryk@redicon.pl', 'lukasz@redicon.pl', 'andrzej@redicon.pl'];
        foreach($users as $user) {
            DB::table('users')->insert([
                'name' => 'redicon',
                'email' => $user,
                'password' => bcrypt(env('PASSWORD')),
                'roles_id' => 1,
            ]);
        }
    }

}
