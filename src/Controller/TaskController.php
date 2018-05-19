<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\Form\TaskTypeImport;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends Controller
{
    /**
     * @Route("/new", name="task_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_index');
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/id/{id}", name="task_show", methods="GET")
     */
    public function show(Task $task): Response
    {
        return $this->render('task/show.html.twig', ['task' => $task]);
    }

    /**
     * @Route("/id/{id}/edit", name="task_edit", methods="GET|POST")
     */
    public function edit(Request $request, Task $task): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_edit',
                ['id' => $task->getId()]);
        }

        return $this->render('task/edit.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/page/{id}", name="task_delete", methods="DELETE")
     * @param Request $request
     * @param Task    $task
     *
     * @return Response
     */
    public function delete(Request $request, Task $task): Response
    {
        if ($this->isCsrfTokenValid('delete' . $task->getId(),
            $request->request->get('_token'))
        ) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();
        }

        return $this->redirectToRoute('task_index');
    }

    /**
     * List of all tasks
     *
     * @Route("/{page}", name="task_index", methods="GET", defaults={"page": 1}, requirements={"page": "\d+"})
     * @param PaginatorInterface $paginator
     *
     * @param int                $page
     *
     * @return Response
     * @throws \LogicException
     */
    public function index(PaginatorInterface $paginator, int $page): Response
    {
        $tasks = $paginator->paginate(
            $this->getDoctrine()->getRepository(Task::class)
                 ->getPaginatedSortedTasksQuery(),
            $page,
            $this->getParameter('max_tasks_on_homepage'));

        return $this->render('task/index.html.twig', compact('tasks'));
    }

    /**
     * @Route("/id/{id}/done", name="task_done", methods="GET")
     * @param Task                   $task
     *
     * @param EntityManagerInterface $em
     *
     * @return Response
     */
    public function done(Task $task, EntityManagerInterface $em): Response
    {
        if ($task->getDone()) {
            $task->setDone(false);
        } else {
            $task->setDone(true);
        }
        $em->flush();

        return $this->redirectToRoute('task_index');
    }

    /**
     * @Route("import", name="task_import")
     *
     * @return Response
     */
    public function import(Request $request): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskTypeImport::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_index');
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form->createView(),
        ]);
    }
}
