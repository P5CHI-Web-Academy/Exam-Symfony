<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TasksController extends Controller
{
    /**
     * @Route("/tasks/{page}", defaults={"page": 1}, name="tasks.index")
     * @Method("GET")
     */
    public function index(int $page, PaginatorInterface $paginator)
    {
        $tasks = $paginator->paginate(
            $this->getDoctrine()->getRepository(Task::class)->getPaginatedTasks(),
            $page,
            $this->getParameter('pagination')
        );

        return $this->render('tasks/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * @Route("/create", name="tasks.create")
     * @Method({"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('tasks.index');
        }
        return $this->render('tasks/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tasks/{id}/edit", name="tasks.edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Task $task
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request, Task $task, EntityManagerInterface $em)
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            return $this->redirectToRoute('tasks.index');
        }
        return $this->render('tasks/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tasks/{task}/delete", name="tasks.delete")
     * @Method("DELETE")
     *
     * @param Task $task
     * @param EntityManagerInterface $em
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Task $task, EntityManagerInterface $em)
    {
        if ($task) {
            $em->remove($task);
            $em->flush();
        }
        return $this->redirectToRoute('tasks.index');
    }

    /**
     * @Route("/tasks/{task}/complete", name="tasks.complete")
     * @Method("PATCH")
     */
    public function completeTask(Request $request, Task $task, EntityManagerInterface $em)
    {
        $value = $request->get('completed');
        $task->setIsCompleted(!!$value);
        $em->persist($task);
        $em->flush();

        return new JsonResponse('!');
    }
}
