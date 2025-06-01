<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function index()
    {
        $ionAuth = service('ionAuth');
        // Pokud je uživatel přihlášen, přesměruj ho
        if ($ionAuth->loggedIn()) {
            return redirect()->to('/');
        }
        return view('login');
    }

    public function auth()
    {
        $identity = $this->request->getPost('identity');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember') ? true : false;

        $ionAuth = service('ionAuth');

        if ($ionAuth->login($identity, $password, $remember)) {
            return redirect()->to('/');
        } else {
            return redirect()->back()
                ->withInput()
                ->with('message', $ionAuth->errors());
        }
    }

    public function logout()
    {
        $ionAuth = service('ionAuth');
        $ionAuth->logout();
        return redirect()->to('/login');
    }
}