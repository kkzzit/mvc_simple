<?php
namespace App\Controller;

use SimpleMVC\Core\Controller\Controller;

/**
 * Subpage controller
 */
class SubpageController extends Controller
{
    public function index()
    {
        return $this->render('subpage/subpage.html.twig', [
            'subpage_text' => 'and this is a subpage',
            'values' => []
        ]);
    }

    /**
     * /subpage/sub/val1/val2 site
     *
     * @param mixed $val1
     * @param mixed $val2
     * @return Rendered page
     */
    public function sub($val1 = null, $val2 = null)
    {
        return $this->render('subpage/subpage.html.twig', [
            'subpage_text' => 'and this is a subpage of the subpage',
            'values' => ['val1' => $val1, 'val2' => $val2]
        ]);
    }
}