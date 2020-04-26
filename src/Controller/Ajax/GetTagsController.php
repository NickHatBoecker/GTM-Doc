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

            $response = new JsonResponse($tagManager->getTags($accountId, $containerId));
            $this->trackRequest();

            return $response;
        } catch (\Exception $e) {
            return new JsonResponse([
                'message' => $e->getMessage()
            ]);
        }
    }

    private function trackRequest()
    {
        $filepath = sprintf("%s/var/tracker.php", $this->getParameter('kernel.project_dir'));
        if (!is_file($filepath)) {
            return;
        }

        $currentSum = (int) file_get_contents($filepath);
        $currentSum += 1;

        file_put_contents($filepath, $currentSum);
    }
}
