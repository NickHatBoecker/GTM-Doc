<?php

namespace App\Service;


use App\Model\Account;
use App\Model\Container;
use App\Model\Tag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class TagManager
{
    /** @var Request */
    private $request;

    /**
     * TagManager constructor.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    /**
     * @return \Google_Service_TagManager
     */
    public function getClient()
    {
        $client = new \Google_Client();
        $client->setAccessToken($this->getAccessToken());

        return new \Google_Service_TagManager($client);
    }

    /**
     * @param string $currentAccountId
     * @param string $currentContainerId
     *
     * @return array
     */
    public function getAccounts(string $currentAccountId = '', string $currentContainerId = '')
    {
        $client = $this->getClient();

        try {
            $accountData = $client->accounts->listAccounts()->getAccount();
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
        } catch (\Google_Service_Exception $e) {
            $error = $e->getErrors()[0];
            if ($error['reason'] === 'authError') {
                throw new UnauthorizedHttpException('You\'re not authorized.');
            }

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
        $client = $this->getClient();

        try {
            $path = sprintf("accounts/%s", $accountId);
            $containerData = $client->accounts_containers->listAccountsContainers($path)->getContainer();
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
        $client = $this->getClient();

        try {
            $workspacePath = sprintf("accounts/%s/containers/%s", $accountId, $containerId);
            $workspaceData = $client->accounts_containers_workspaces
                ->listAccountsContainersWorkspaces($workspacePath)
                ->getWorkspace();

            /** @var \Google_Service_TagManager_Workspace $workspace */
            $workspace = $workspaceData[0];

            $tagPath = sprintf("%s/workspaces/%s", $workspacePath, $workspace->getWorkspaceId());

            $tagsData = $client->accounts_containers_workspaces_tags
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
     * @return string
     */
    private function getAccessToken (): string {
        $authorization = $this->request->headers->get('Authorization');
        if (!$authorization) {
            throw new AccessDeniedHttpException('Access denied.');
        }

        return str_replace('Bearer ', '', $authorization);
    }
}
