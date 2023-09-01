<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        $title  = 'Login';

        return view('auth/login', [
            'title' => $title
        ]);
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $model = new UserModel();

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {

            $model->update($user['id_user'], ['islogin' => 1]);

            session()->set('isLoggedIn', true);
            session()->set('userID', $user['id_user']);
            session()->set('userEmail', $user['email']);
            session()->set('userName', $user['name']);
            session()->set('userImage', $user['image']);

            session()->setFlashdata('success', 'Log in Success !');
            return redirect()->to('/dashboard');
        } else {
            session()->setFlashdata('error', 'Log in Failed !');
            return redirect()->to('/login');
        }
    }


    public function logout()
    {
        $userID = session('userID');

        if ($userID) {
            $model = new UserModel();
            $whereCondition = ['id_user' => $userID];
            $model->set('islogin', 0)->where($whereCondition)->update();
        }

        session()->destroy();

        session()->setFlashdata('success', 'Log out Success !');

        return redirect()->to('/login');
    }
}
