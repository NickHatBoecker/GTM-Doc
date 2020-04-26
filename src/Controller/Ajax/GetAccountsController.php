<?php

namespace App\Controller\Ajax;

use App\Service\TagManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class GetAccountsController
{
    /**
     * @Route("/api/ajax/get-accounts/", name="app.ajax.get_accounts", methods={"GET"})
     *
     * @return Response
     */
    public function index (TagManager $tagManager) {
        return new JsonResponse($tagManager->getAccounts());
    }
}
