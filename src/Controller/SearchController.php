<?php

namespace App\Controller;

use App\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    /**
     * @Route("/search/search", name="search.tasks")
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request)
    {
        $query = $request->get('query');

        $tasks = $this->getDoctrine()->getRepository(Task::class)->findTasksByKeywords($query);

        return $this->render('search/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }
}
