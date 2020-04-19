<?php

namespace App\Controller;

use App\Service\TagManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="app.home", methods={"GET"})
     */
    public function homeAction(SessionInterface $session, TagManager $tagManager)
    {
        return $this->render('home.html.twig', [
            'accounts' => $tagManager->getAccounts(),
        ]);
    }
}
