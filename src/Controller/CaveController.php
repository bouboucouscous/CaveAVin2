<?php

namespace App\Controller;
use App\Entity\Utilisateur;

use App\Entity\Cave;
use App\Form\CaveType;
use App\Repository\CaveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/cave')]
class CaveController extends AbstractController
{
    #[Route('/', name: 'app_cave_index', methods: ['GET'])]
    public function index(CaveRepository $caveRepository, UserInterface $user): Response
    {
        $userId = $user->getId();
        //\Doctrine\Common\Util\Debug::dump($userId);
        return $this->render('cave/index.html.twig', [
            'caves' => $caveRepository->findAllWhitNameWine($userId),
        ]);
    }

    #[Route('/new', name: 'app_cave_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CaveRepository $caveRepository): Response
    {
        $cave = new Cave();
        $form = $this->createForm(CaveType::class, $cave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $caveRepository->save($cave, true);

            return $this->redirectToRoute('app_cave_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cave/new.html.twig', [
            'cave' => $cave,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cave_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cave $cave, CaveRepository $caveRepository): Response
    {
        $form = $this->createForm(CaveType::class, $cave);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $caveRepository->save($cave, true);

            return $this->redirectToRoute('app_cave_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cave/edit.html.twig', [
            'cave' => $cave,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cave_delete', methods: ['POST'])]
    public function delete(Request $request, Cave $cave, CaveRepository $caveRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cave->getId(), $request->request->get('_token'))) {
            $caveRepository->remove($cave, true);
        }

        return $this->redirectToRoute('app_cave_index', [], Response::HTTP_SEE_OTHER);
    }
}
