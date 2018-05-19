<?php

namespace App\Controller;

use App\Entity\ListTask;
use App\Form\ListTaskType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/list/task")
 */
class ListTaskController extends Controller
{
    /**
     * @Route("/{page}", name="list_task_index", methods="GET", defaults={"page": 1}, requirements={"page" = "\d+"})
     * @param int $page
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(int $page, PaginatorInterface $paginator): Response
    {
        $listTaskSort = $paginator->paginate(
            $this->getDoctrine()
                ->getRepository(ListTask::class)
                ->sortTaskList(),
            $page,
            $this->getParameter('max_list'));
        return $this->render('list_task/index.html.twig', [
            'list_tasks_sort' => $listTaskSort,
        ]);
    }
    
    /**
     * @Route("/new", name="list_task_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $listTask = new ListTask();
        $form = $this->createForm(ListTaskType::class, $listTask);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($listTask);
            $em->flush();
            
            return $this->redirectToRoute('list_task_index');
        }
        
        return $this->render('list_task/new.html.twig', [
            'list_task' => $listTask,
            'form' => $form->createView(),
        ]);
    }
    
    
    /**
     * @Route("/{id}/edit", name="list_task_edit", methods="GET|POST")
     * @param Request $request
     * @param ListTask $listTask
     * @return Response
     */
    public function edit(Request $request, ListTask $listTask): Response
    {
        $form = $this->createForm(ListTaskType::class, $listTask);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('list_task_edit', ['id' => $listTask->getId()]);
        }
        
        return $this->render('list_task/edit.html.twig', [
            'list_task' => $listTask,
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route("/{id}/delete", name="list_task_delete", methods="GET")
     * @param Request $request
     * @param ListTask $listTask
     * @return Response
     */
    public function delete(Request $request, ListTask $listTask): Response
    {
        if ($this->isCsrfTokenValid('delete' . $listTask->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($listTask);
            $em->flush();
        }
        
        return $this->redirectToRoute('list_task_index', ['page' => 1]);
    }
    
    /**
     * @Route("/import", name="list_task_import", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function import(Request $request): Response
    {
        $task = new ListTask();
        $form = $this->createFormBuilder($task)
            ->add('title', FileType::class, ['label' => 'Task*'
            ])
            ->add('priority', ChoiceType::class, [
                'choices' => array(
                    'High' => 3,
                    'Normal' => 2,
                    'Low' => 1)
            ])->getForm();
        if ($form->isSubmitted() && $form->isValid()) {
        
        }
        return $this->render('list_task/import.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function markItem()
    {
    
    }
}
