<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Local;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Immobilier');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Retour', 'fas fa-home', 'home');
        yield MenuItem::linkToCrud('Locaux', 'fas fa-map-marker-alt', Local::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-comments', Categorie::class);
    }
}
