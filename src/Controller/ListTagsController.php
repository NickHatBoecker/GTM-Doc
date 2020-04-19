<?php

namespace App\Controller;


use App\Service\TagManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListTagsController extends Controller
{
    /**
     * @Route("/account/{accountId}/container/{containerId}", name="app.list_tags", methods={"GET"})
     *
     * @param string $accountId
     *
     * @return Response
     */
    public function index(string $accountId, string $containerId, TagManager $tagManager)
    {
        return $this->render('list_tags.html.twig', [
            'accounts' => $tagManager->getAccounts(),
            'accountId' => $accountId,
            'containerId' => $containerId,
            'tags' => $tagManager->getTags($accountId, $containerId),
        ]);
    }
}
