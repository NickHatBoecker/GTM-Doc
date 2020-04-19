<?php

namespace App\Service;


use App\Model\Account;
use App\Model\Container;
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
     * @param string $currentAccountId
     * @param string $currentContainerId
     *
     * @return array
     */
    public function getAccounts(string $currentAccountId = '', string $currentContainerId = '')
    {
        if (!$this->tagManager) {
            return [];
        }

        try {
            $accountData = $this->tagManager->accounts->listAccounts()->getAccount();
            $accounts = [];
            foreach ($accountData as $account) {
                /** @var \Google_Service_TagManager_Account $account */
                $accounts[] = new Account(
                    $account->getAccountId(),
                    $account->getName(),
                    $account->getAccountId() === $currentAccountId,
                    $this->getContainers($account->getAccountId(), $currentContainerId)
                );
            }

            return $accounts;
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param string $accountId
     * @param string $currentContainerId
     *
     * @return array
     */
    public function getContainers(string $accountId, string $currentContainerId)
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
                $containers[] = new Container(
                    $container->getContainerId(),
                    $container->getName(),
                    $container->getContainerId() == $currentContainerId
                );
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

    /**
     * @param array $accounts
     *
     * @return array
     */
    public function getBreadcrumb(array $accounts)
    {
        $breadcrumb = [];

        foreach ($accounts as $account) {
            if (!$account->selected) {
                continue;
            }

            $breadcrumb[] = $account->name;

            foreach ($account->containers as $container) {
                if (!$container->selected) {
                    continue;
                }

                $breadcrumb[] = $container->name;
            }
        }

        return $breadcrumb;
    }
}
