<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\VinRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Vin;

class CaveAVinController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(VinRepository $vinRepository, Request $request, PaginatorInterface $paginationInterface, EntityManagerInterface $entityManager): Response
    {
        $annees = $entityManager->getRepository(Vin::class)->getDistinctAnnees();
        $robe = $entityManager->getRepository(Vin::class)->getDistinctRobe();
        $format = $entityManager->getRepository(Vin::class)->getDistinctFormat();
        $teneurEnSucre = $entityManager->getRepository(Vin::class)->getDistinctTeneurEnSucre();

        $pagination = $paginationInterface->paginate(
            $vinRepository->paginationQuery(),
            $request->query->get('page',1),
            5
        );

        //\Doctrine\Common\Util\Debug::dump($teneurEnSucre);

        return $this->render('cave_a_vin/index.html.twig', [
            'pagination' => $pagination,
            'annees' => $annees,
            'robes' => $robe,
            'formats' => $format,
            'teneurEnSucres' => $teneurEnSucre
        ]);
    }

    #[Route('/filtre', name: 'filtre')]
    public function indexFilter(VinRepository $vinRepository, Request $request, PaginatorInterface $paginationInterface, EntityManagerInterface $entityManager): Response
    {
        $annee = $request->query->get('annee');
        $formatCl = $request->query->get('formatCl');
        $robe = $request->query->get('robe');
        $teneurEnSucre = $request->query->get('teneurEnSucre');

        // Ajouter les filtres à l'array des filtres
        if ($annee) {
            $filters['annee'] = $annee;
        }
        if ($formatCl) {
            $filters['formatCl'] = $formatCl;
        }
        if ($robe) {
            $filters['robe'] = $robe;
        }
        if ($teneurEnSucre) {
            $filters['teneurEnSucre'] = $teneurEnSucre;
        }

        // Récupérer les vins correspondants aux filtres
        $vins = $vinRepository->findByFilters($filters);


        $pagination = $paginationInterface->paginate(
            $vinRepository->findByFilters($filters),
            $request->query->get('page',1),
            5
        );

        return $this->render('cave_a_vin/index.html.twig', [
            'pagination' => $pagination,
            'annees' => $annees,
        ]);
    }
}
