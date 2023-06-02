<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Vin;
use App\Form\VinType;
use App\Repository\VinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/vin')]
class VinController extends AbstractController
{
    #[Route('/new', name: 'app_vin_new', methods: ['GET', 'POST'])]
    public function new(Request $request, VinRepository $vinRepository, EntityManagerInterface $entityManager): Response
    {
        $vin = new Vin();
        $form = $this->createForm(VinType::class, $vin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {

                $vinRepository->save($vin, true);
                $newFilename = $vin->getId();
                $imageFile->move(
                    $this->getParameter('imgVinPath'),
                    $newFilename
                );

            }

            return $this->redirectToRoute('app_utilisateur', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vin/new.html.twig', [
            'vin' => $vin,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vin_detail', methods: ['GET'])]
    public function show(Vin $vin): Response
    {
        return $this->render('cave_a_vin/detail.html.twig', [
            'vin' => $vin,
        ]);
    }

}
