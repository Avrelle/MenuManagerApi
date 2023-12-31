<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Menu;
use App\Entity\Order;
use App\Entity\OrderDescription;
use App\Entity\Plate;
use App\Entity\Table;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted("ROLE_ADMIN")]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MenuManagerApi');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Tables', 'fas fa-table', Table::class);
        yield MenuItem::linkToCrud('Menus', 'fas fa-list', Menu::class);
        yield MenuItem::linkToCrud('Plates', 'fas fa-list', Plate::class);
        yield MenuItem::linkToCrud('Orders Desciprion', 'fas fa-list', OrderDescription::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('Orders', 'fas fa-list', Order::class);

    }
}