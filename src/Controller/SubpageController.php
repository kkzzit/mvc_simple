<?php
namespace App\Controller;

use SimpleMVC\Core\Controller\Controller;

class SubpageController extends Controller
{
    public function index()
    {
        return $this->render('subpage/subpage.html.twig', [
            'subpage_text' => 'and this is a subpage',
            'values' => []
        ]);
    }

    public function sub($val1 = null, $val2 = null)
    {
        return $this->render('subpage/subpage.html.twig', [
            'subpage_text' => 'and this is a subpage of the subpage',
            'values' => ['val1' => $val1, 'val2' => $val2]
        ]);
    }
}