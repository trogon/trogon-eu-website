<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubClientService
{
    private $logger;
    private $githubApiClient;
    private $githubOauthClient;

    public function __construct(
        LoggerInterface $logger,
        HttpClientInterface $githubApiClient,
        HttpClientInterface $githubOauthClient)
    {
        $this->logger = $logger;
        $this->githubApiClient = $githubApiClient;
        $this->githubOauthClient = $githubOauthClient;
    }

    public function getRepositoriesResponse()
    {
        $githubLink = '/users/trogon/repos';
        return $this->githubApiClient->request('GET', $githubLink);
    }

    public function stream($responses)
    {
        return $this->githubApiClient->stream($responses);
    }
}
