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
        $accounts = $tagManager->getAccounts($accountId, $containerId);

        return $this->render('list_tags.html.twig', [
            'accounts' => $accounts,
            'accountId' => $accountId,
            'containerId' => $containerId,
            'tags' => $tagManager->getTags($accountId, $containerId),
            'breadcrumb' => $tagManager->getBreadcrumb($accounts),
        ]);
    }
}
