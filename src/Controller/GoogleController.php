<?php

namespace App\Controller;


use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GoogleController extends Controller
{
    /**
     * @Route("/api/connect/google", name="connect_google_start", methods={"GET"})
     *
     * @param ClientRegistry $clientRegistry
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function connectAction(ClientRegistry $clientRegistry, SessionInterface $session)
    {
        if ($session->get('access_token')) {
            return $this->redirectToRoute('app.home');
        }

        return $clientRegistry
            ->getClient('google') // key used in config/packages/knpu_oauth2_client.yaml
            ->redirect([ 'https://www.googleapis.com/auth/tagmanager.readonly' ], [])
        ;
    }

    /**
     * @Route("/api/connect/google/check", name="connect_google_check", methods={"GET"})
     *
     * @param Request $request
     * @param ClientRegistry $clientRegistry
     */
    public function connectCheckAction(Request $request, ClientRegistry $clientRegistry, SessionInterface $session)
    {
        try {
            $client = $clientRegistry->getClient('google');
            $accessToken = $client->getAccessToken()->getToken();

            return $this->redirectToRoute('app.home', [ 'accessToken' => $accessToken ]);
        } catch (\Exception $e) {
            // @TODO Do nothing yet
        }

        return $this->redirectToRoute('app.home');
    }
}
