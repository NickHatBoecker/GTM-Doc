<?php

namespace App\Controller;


use App\Service\TagManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DataPrivacyController extends Controller
{
    /**
     * @Route("/data-privacy", name="app.data_privacy", methods={"GET"}))
     *
     * @param TagManager $tagManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TagManager $tagManager)
    {
        return $this->render('data_privacy.html.twig', [
            'accounts' => $tagManager->getAccounts(),
        ]);
    }
}
