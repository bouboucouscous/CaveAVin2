<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use App\Entity\Robe;
use App\Entity\TeneurEnSucre;
use App\Entity\Utilisateur;
use App\Entity\Cave;
use App\Entity\Vin;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(RobeCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to web site', 'fas fa-home','homepage');
        yield MenuItem::linkToCrud('Robe','fa-sharp fa-solid fa-wine-glass',Robe::Class);        
        yield MenuItem::linkToCrud('TeneurEnSucre','fa-sharp fa-solid fa-cubes-stacked',TeneurEnSucre::Class);
        yield MenuItem::linkToCrud('Vin','fa-solid fa-wine-bottle',Vin::Class);
        yield MenuItem::linkToCrud('Utilisateur','fa-solid fa-user',Utilisateur::Class);
    }
}
