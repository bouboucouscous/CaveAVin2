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

        //\Doctrine\Common\Util\Debug::dump($robe);

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

        if($annee || $formatCl || $robe || $teneurEnSucre)
        {
            $getDistinctAnnees = $entityManager->getRepository(Vin::class)->getDistinctAnnees();
            $getDistinctRobe = $entityManager->getRepository(Vin::class)->getDistinctRobe();
            $getDistinctFormat = $entityManager->getRepository(Vin::class)->getDistinctFormat();
            $getDistinctTeneurEnSucre = $entityManager->getRepository(Vin::class)->getDistinctTeneurEnSucre();

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
                        
            $pagination = $paginationInterface->paginate(
                $vinRepository->findByFilters($filters),
                $request->query->get('page',1),
                5
            );
    
            return $this->render('cave_a_vin/filter.html.twig', [
                'pagination' => $pagination,
                'annees' => $getDistinctAnnees,
                'robes' => $getDistinctRobe,
                'formats' => $getDistinctFormat,
                'teneurEnSucres' => $getDistinctTeneurEnSucre
            ]);
        }
        else
        {
            return $this->redirectToRoute('homepage');
        }
    }

    #[Route('/vin/{id}', name: 'app_vin_detail')]
    public function showVinDetail(Vin $vin): Response
    {
        return $this->render('cave_a_vin/detail.html.twig', [
            'vin' => $vin,
        ]);
    }
}


