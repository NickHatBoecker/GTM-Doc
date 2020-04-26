<?php

namespace App\Controller\Ajax;


use App\Service\TagManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetTagsController extends Controller
{
    /**
     * @Route("/api/ajax/get-tags/", name="app.ajax.get_tags", methods={"GET"})
     *
     * @param Request $request
     * @param TagManager $tagManager
     *
     * @return Response
     */
    public function index(Request $request, TagManager $tagManager)
    {
        try {
            $accountId = $request->get('accountId', '');
            $containerId = $request->get('containerId', '');

            return new JsonResponse($tagManager->getTags($accountId, $containerId));
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage()
            ]);
        }
    }
}
