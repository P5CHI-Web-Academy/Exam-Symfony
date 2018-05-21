<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\ImportType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/task")
 */
class TaskActionsController extends Controller
{
    /**
     * @Route("/import", name="task_import", methods="GET|POST")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $form = $this->createForm(ImportType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $priority = $form->get('priority')->getData();
            /** @var UploadedFile $file */
            $file = $form->get('tasks')->getData();

            $jsonArr = json_decode(file_get_contents($file->getPathname()));
            foreach ($jsonArr as $taskEntry) {
                $task = new Task();
                $task->setName($taskEntry->name);
                $task->setDescription($taskEntry->description);
                $task->setPriority($priority);
                $task->setIsDone(false);

                $em->persist($task);
                $em->flush();
            }

            return $this->redirectToRoute('task_index');
        }

        return $this->render('task/import.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
