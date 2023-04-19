<?php

namespace App\Controller;

use App\Service\TagManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="app.home", methods={"GET"})
     * @Route("/{vueRouting}", name="app.vue.home", methods={"GET"}, requirements={"vueRouting"="^(?!api|_(profiler|wdt)).*"})
     */
    public function homeAction(SessionInterface $session, TagManager $tagManager)
    {
        $accounts = [];
        try {
            $accounts = $tagManager->getAccounts();
        } catch (\Exception $e) {
            // Do nothiing
        }

        return $this->render('base.html.twig', [
            'accounts' => $accounts,
        ]);
    }
}
