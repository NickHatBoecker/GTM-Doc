<?php

namespace App\Controller;


use App\Service\TagManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ListContainersController extends Controller
{
    /**
     * @Route("/account/{accountId}", name="app.list_containers", methods={"GET"})
     *
     * @param string $accountId
     *
     * @return Response
     */
    public function index(string $accountId, TagManager $tagManager, SessionInterface $session)
    {
        return $this->render('list_containers.html.twig', [
            'accounts' => $tagManager->getAccounts(),
            'accountId' => $accountId,
            'containers' => $tagManager->getContainers($accountId),
        ]);
    }
}
