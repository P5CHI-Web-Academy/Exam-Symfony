<?php

namespace App\Controller;

use App\Entity\MyList;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MyListController extends AbstractController
{

    /**
     * @Route("/", name="name.list")
     *
     * @Method("GET")
     *
     * @return Response
     *
     */
    public function list() : Response
    {
        $names = $this->getDoctrine()->getRepository(MyList::class)->findAll();

        return $this->render('name/list.html.twig', [
            'names' => $names,
        ]);
    }

    /**
     * @Route("name/{id}", name="name.show", requirements={"id" = "\d+"})
     *
     * @Method("GET")
     *
     * @param MyList $name
     *
     * @return Response
     *
     */
    public function show(MyList $name) : Response
    {
        $names = $this->getDoctrine()->getRepository(MyList::class)->findAll();

        return $this->render('name/list.html.twig', [
            'names' => $names,
        ]);
    }
}
