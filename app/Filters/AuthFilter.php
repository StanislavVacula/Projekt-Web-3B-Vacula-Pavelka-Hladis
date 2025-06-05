<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use IonAuth\Libraries\IonAuth;

class AuthFilter implements FilterInterface
{
    protected $ionAuth;
    protected $session;

    public function __construct()
    {
        $this->ionAuth = new IonAuth();
        $this->session = \Config\Services::session();
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        if (!$this->ionAuth->loggedIn()) {
            $this->session->setFlashdata('message', 'Pro přístup do administrace se musíte přihlásit.');
            return redirect()->route('prihlaseni');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nevyužíváme
    }
}