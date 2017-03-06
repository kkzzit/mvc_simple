<?php
namespace App\Controller;

use SimpleMVC\Core\Controller\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return $this->render('home/home.html.twig');
    }
}