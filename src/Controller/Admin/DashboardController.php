<?php

namespace App\Controller\Admin;

use App\Entity\Rendezvous;
use App\Controller\Admin\RendezvousCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        $url = $adminUrlGenerator
            ->setController(RendezvousCrudController::class)
            ->setAction(Action::INDEX)
            ->generateUrl();

        return $this->redirect($url);
    }



    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Rendezvous', 'fa fa-calendar', Rendezvous::class);
    }

    public function fetchRendezvous(): string
    {
        return $this->container->get(AdminUrlGenerator::class)
            ->setController(RendezvousCrudController::class)
            ->setAction(Action::INDEX)
            ->generateUrl();
    }
}