<?php

namespace App\Controller;

use App\Entity\Priority;
use App\Entity\Item;
use App\Form\ItemImportTyoe;
use App\Form\ItemType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->persist($item);
            $em->flush();

            $this->addFlash('notice', 'New To-Do has been added');

            return $this->redirectToRoute(
                'item.list'
            );
        }

        return $this->render('item/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/import", name="import")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function import(Request $request, EntityManagerInterface $em): Response
    {
        // TODO: make it work
        /*
        $item = new Item();
        $form = $this->createForm(ItemImportType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->persist($item);
            $em->flush();

            $this->addFlash('notice', 'New To-Do has been added');

            return $this->redirectToRoute(
                'item.list'
            );
        }

        return $this->render('item/import.html.twig', [
            'form' => $form->createView(),
        ]);
        */
    }


    /**
     * @Route("/item/{id}/edit", name="edit", requirements={"id" = "\d+"})
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param Item $item
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function edit(Request $request, Item $item, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('notice', 'To-Do info has been updated');

            return $this->redirectToRoute(
                'item.list'
            );
        }

        return $this->render('item/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/item/{id}/delete", name="delete", requirements={"id" = "\d+"})
     * @Method({"DELETE", "POST"})
     * @param Item $item
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function delete(Item $item, EntityManagerInterface $em): Response
    {
        $em->remove($item);
        $em->flush();

        $this->addFlash('notice', 'To-Do item has been deleted');

        return $this->redirectToRoute('item.list');
    }

    /**
     * @Route("/item/{id}/done", name="markAsDone", requirements={"id" = "\d+"})
     * @Method({"POST"})
     * @param Request $request
     * @param Item $item
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function markAsDone(Request $request, Item $item, EntityManagerInterface $em): Response
    {
        if ($request->request->get('state') !== null) {
            if ($request->request->get('state')) {
                $item->setDone(true);
            } else {
                $item->setDone(true);
            }
        }
        $em->flush();

        return new JsonResponse(['success' => 'Ok']);
    }

    /**
     * @param Item $item
     * @return FormInterface
     */
    public function createDeleteForm(Item $item): FormInterface
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('item.delete', ['id' => $item->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }
}
