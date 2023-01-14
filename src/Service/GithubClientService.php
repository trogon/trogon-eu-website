<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubClientService
{
    public function __construct(
        private LoggerInterface $logger,
        private HttpClientInterface $githubApiClient,
        private HttpClientInterface $githubOauthClient
    ) {
    }

    public function getRepositoriesResponse($user)
    {
        $reposLink = "/users/{$user}/repos";
        return $this->githubApiClient->request('GET', $reposLink);
    }

    public function getTagsResponse($project_fullname)
    {
        $tagsLink = "/repos/{$project_fullname}/tags";
        return $this->githubApiClient->request('GET', $tagsLink);
    }

    public function stream($responses)
    {
        return $this->githubApiClient->stream($responses);
    }
}
