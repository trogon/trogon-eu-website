<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubClientService
{
    private $logger;
    private $apiClient;
    private $oauthClient;

    public function __construct(
        LoggerInterface $logger,
        HttpClientInterface $githubApiClient,
        HttpClientInterface $githubOauthClient)
    {
        $this->logger = $logger;
        $this->apiClient = $githubApiClient;
        $this->oauthClient = $githubOauthClient;
    }

    public function getRepositoriesResponse($user)
    {
        $reposLink = "/users/{$user}/repos";
        return $this->apiClient->request('GET', $reposLink);
    }

    public function getTagsResponse($project_fullname)
    {
        $tagsLink = "/repos/{$project_fullname}/tags";
        return $this->apiClient->request('GET', $tagsLink);
    }

    public function stream($responses)
    {
        return $this->apiClient->stream($responses);
    }
}
