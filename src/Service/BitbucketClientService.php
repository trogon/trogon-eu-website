<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class BitbucketClientService
{
    private $logger;
    public $apiClient;
    private $oauthClient;

    public function __construct(
        LoggerInterface $logger,
        HttpClientInterface $bitbucketApiClient,
        HttpClientInterface $bitbucketOauthClient)
    {
        $this->logger = $logger;
        $this->apiClient = $bitbucketApiClient;
        $this->oauthClient = $bitbucketOauthClient;
    }

    public function getAccessTokenResponse()
    {
        return $this->oauthClient->request('POST', 'access_token', [
            'body' => ['grant_type' => 'client_credentials']
        ]);
    }

    public function getRepositoriesResponse($user, $auth_token, $next_link=null)
    {
        $reposLink = "/2.0/repositories/{$user}?pagelen=10&fields=-*.links,-*.owner,-*.project,-*.mainbranch";
        if (!empty($next_link)) {
            $reposLink = $next_link;
        }
        return $this->apiClient->request('GET', $reposLink, [
            'auth_bearer' => $auth_token
        ]);
    }

    public function getTagsResponse($project_fullname, $auth_token, $next_link=null)
    {
        $tagsLink = "/2.0/repositories/{$project_fullname}/refs/tags";
        if (!empty($next_link)) {
            $tagsLink = $next_link;
        }
        return $this->apiClient->request('GET', $tagsLink, [
            'auth_bearer' => $auth_token
        ]);
    }

    public function stream($responses)
    {
        return $this->apiClient->stream($responses);
    }
}
