<?php

namespace App\Service;


use App\Model\Tag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TagManager
{
    /** @var \Google_Service_TagManager */
    private $tagManager;

    /**
     * TagManager constructor.
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $accessToken = $session->get('access_token');
        if (!$accessToken) {
            return;
        }

        try {
            $client = new \Google_Client();
            $client->setAccessToken($accessToken);

            $this->tagManager = new \Google_Service_TagManager($client);
        } catch (\Exception $e) {
            // Do nothing
        }
    }

    /**
     * @return array
     */
    public function getAccounts()
    {
        if (!$this->tagManager) {
            return [];
        }

        try {
            $accountData = $this->tagManager->accounts->listAccounts()->getAccount();
            $accounts = [];
            foreach ($accountData as $account) {
                /** @var \Google_Service_TagManager_Account $account */
                $accounts[] = [
                    'id' => $account->getAccountId(),
                    'name' => $account->getName(),
                ];
            }

            return $accounts;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param string $accountId
     *
     * @return array
     */
    public function getContainers(string $accountId)
    {
        if (!$this->tagManager) {
            return [];
        }

        try {
            $path = sprintf("accounts/%s", $accountId);
            $containerData = $this->tagManager->accounts_containers->listAccountsContainers($path)->getContainer();
            $containers = [];
            foreach ($containerData as $container) {
                /** @var \Google_Service_TagManager_Container $container */
                $containers[] = [
                    'id' => $container->getContainerId(),
                    'name' => $container->getName(),
                ];
            }

            return $containers;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param string $accountId
     * @param string $containerId
     *
     * @return array
     */
    public function getTags(string $accountId, string $containerId)
    {
        if (!$this->tagManager) {
            return [];
        }

        try {
            $workspacePath = sprintf("accounts/%s/containers/%s", $accountId, $containerId);
            $workspaceData = $this->tagManager->accounts_containers_workspaces
                ->listAccountsContainersWorkspaces($workspacePath)
                ->getWorkspace();

            /** @var \Google_Service_TagManager_Workspace $workspace */
            $workspace = $workspaceData[0];

            $tagPath = sprintf("%s/workspaces/%s", $workspacePath, $workspace->getWorkspaceId());

            $tagsData = $this->tagManager->accounts_containers_workspaces_tags
                ->listAccountsContainersWorkspacesTags($tagPath)
                ->getTag()
            ;

            foreach ($tagsData as $tag) {
                $tags[] = new Tag($tag);
            }

            return $tags;
        } catch (\Exception $e) {
            return [];
        }
    }
}
