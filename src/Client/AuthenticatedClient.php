<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Client;

use Psr\Http\Message\ResponseInterface;
use Semaio\MailchimpApi\Configuration\Configuration;

/**
 * Class AuthenticatedClient
 */
class AuthenticatedClient implements HttpClientInterface
{
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * AuthenticatedClient constructor.
     *
     * @param Configuration       $configuration
     * @param HttpClientInterface $client
     */
    public function __construct(Configuration $configuration, HttpClientInterface $client)
    {
        $this->configuration = $configuration;
        $this->client = $client;
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(string $httpMethod, $uri, array $headers = [], $body = null): ResponseInterface
    {
        $headers['Authorization'] = 'apikey ' . $this->configuration->getApiKey();

        return $this->client->sendRequest($httpMethod, $uri, $headers, $body);
    }
}
