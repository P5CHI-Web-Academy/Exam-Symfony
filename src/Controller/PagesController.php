<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->redirectToRoute('tasks.index');
    }
}
