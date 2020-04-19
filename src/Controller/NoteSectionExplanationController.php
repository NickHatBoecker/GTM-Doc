<?php

namespace App\Controller;


use App\Service\TagManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class NoteSectionExplanationController extends Controller
{
    /**
     * @Route("/note-section-explanation", name="app.note_section_explanation", methods={"GET"})
     *
     * @param TagManager $tagManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TagManager $tagManager)
    {
        return $this->render('note_section_explanation.html.twig', [
            'accounts' => $tagManager->getAccounts(),
        ]);
    }
}
