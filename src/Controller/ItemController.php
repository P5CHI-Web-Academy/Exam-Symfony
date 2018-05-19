<?php

namespace App\Controller;

use App\Entity\Priority;
use App\Entity\Item;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Symfony\Component\Form\FormInterface;

/**
 * @Route(name="item.")
 */
class ItemController extends Controller {

    /**
     * @Route("/{page}", name="list", requirements={"page" = "\d+"}, defaults={"page": 1})
     * @Method("GET")
     * @param int $page
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function list(
        int $page,
        PaginatorInterface $paginator
    ): Response {
        $items = $paginator->paginate(
            $this->getDoctrine()->getRepository(Item::class)->findAllItemsSortedBypriority(),
            $page,
            $this->getParameter('items_show_limit_main')
        );

        return $this->render('item/list.html.twig', [
            'items' => $items,
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        /*
        $job = new Item();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($job);
            $em->flush();

            $this->addFlash('notice', 'Job has been created');

            return $this->redirectToRoute(
                'job.view',
                ['token' => $job->getToken(),]
            );
        }

        return $this->render('job/create.html.twig', [
            'form' => $form->createView(),
        ]);
        */
    }
}
