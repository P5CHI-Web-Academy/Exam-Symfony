<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Form\TaskType;

/**
 * @Route(name="app.")
 */
class TaskController extends Controller
{
    /**
     * @Route("/{page}",
     *      name="task.list",
     *      requirements={"page"="\d+"},
     *      defaults={"page"=1}
     * )
     * @Method("GET")
     *
     * @param PaginatorInterface $paginator
     * @param TaskRepository $taskRepository
     * @param int $page
     * @return Response
     */
    public function list(PaginatorInterface $paginator, TaskRepository $taskRepository, int $page)
    {
        $activeTasks = $paginator->paginate(
            $taskRepository->getActiveTasksQuery(),
            $page,
            $this->getParameter('max_task_on_homepage')
        );

        return $this->render(
            'task/list.html.twig',
            ['activeTasks' => $activeTasks]
        );
    }

    /**
     *
     * @Route("/create", name="task.create")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function create(Request $request)
    {
        $task = new Task();

        return $this->update($task, $request);
    }

    /**
     *
     * @Route("/{id}/update", name="task.update", requirements={"id"="\d+"})
     * @Method({"GET", "POST"})
     *
     * @param Task $task
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function updateAction(Task $task, Request $request): Response
    {
        return $this->update($task, $request);
    }

    /**
     * @param Task $task
     * @param Request $request
     * @return Response
     */
    private function update(Task $task, Request $request): Response
    {
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            $this->addFlash('notice', 'Task has been saved');

            return $this->redirectToRoute('app.task.list');
        }

        return $this->render(
            'task/update.html.twig',
            [
                'task' => $task,
                'form' => $form->createView(),
            ]
        );
    }
}
