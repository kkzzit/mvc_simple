<?php
namespace App\Controller;

use SimpleMVC\Core\Controller\Controller;

/**
 * Home page controller
 */
class HomeController extends Controller
{
    public function index()
    {
        return $this->render('home/home.html.twig');
    }
}