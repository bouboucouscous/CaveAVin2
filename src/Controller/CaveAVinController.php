<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CaveAVinController extends AbstractController
{
    #[Route('/cave/a/vin', name: 'app_cave_a_vin')]
    public function index(): Response
    {
        return $this->render('cave_a_vin/index.html.twig', [
            'controller_name' => 'CaveAVinController',
        ]);
    }
}
