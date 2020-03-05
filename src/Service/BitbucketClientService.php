<?php
namespace App\Service;

use Psr\Log\LoggerInterface;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class BitbucketClientService
{
    private $logger;
    public $bitbucketApiClient;
    private $bitbucketOauthClient;

    public function __construct(
        LoggerInterface $logger,
        HttpClientInterface $bitbucketApiClient,
        HttpClientInterface $bitbucketOauthClient)
    {
        $this->logger = $logger;
        $this->bitbucketApiClient = $bitbucketApiClient;
        $this->bitbucketOauthClient = $bitbucketOauthClient;
    }

    public function getAccessTokenResponse()
    {
        return $this->bitbucketOauthClient->request('POST', 'access_token', [
            'body' => ['grant_type' => 'client_credentials']
        ]);
    }

    public function getRepositoriesResponse($auth_token, $next_link=null)
    {
        $bitbucketLink = '/2.0/repositories/trogon-studios?pagelen=10&fields=-*.links,-*.owner,-*.project,-*.mainbranch';
        if (!empty($next_link)) {
            $bitbucketLink = $next_link;
        }
        return $this->bitbucketApiClient->request('GET', $bitbucketLink, [
            'auth_bearer' => $auth_token
        ]);
    }

    public function getTagsResponse($auth_token, $project_fullname)
    {
        $bitbucketLink = "/2.0/repositories/{$project_fullname}/refs/tags";
        return $this->bitbucketApiClient->request('GET', $bitbucketLink, [
            'auth_bearer' => $auth_token
        ]);
    }

    public function stream($responses)
    {
        return $this->bitbucketApiClient->stream($responses);
    }
}
