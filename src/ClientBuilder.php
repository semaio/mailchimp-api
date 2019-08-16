<?php declare(strict_types=1);

namespace Semaio\MailchimpApi;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Semaio\MailchimpApi\Api\ListApi;
use Semaio\MailchimpApi\Api\PingApi;
use Semaio\MailchimpApi\Client\AuthenticatedClient;
use Semaio\MailchimpApi\Client\HttpClient;
use Semaio\MailchimpApi\Client\ResourceClient;
use Semaio\MailchimpApi\Configuration\Configuration;
use Semaio\MailchimpApi\Routing\UriGenerator;

class ClientBuilder
{
    /**
     * @var null|ClientInterface
     */
    private $httpClient;

    /**
     * @var null|RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var null|StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        if ($this->httpClient === null) {
            $this->httpClient = Psr18ClientDiscovery::find();
        }

        return $this->httpClient;
    }

    /**
     * @param ClientInterface $httpClient
     */
    public function setHttpClient(ClientInterface $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return RequestFactoryInterface
     */
    public function getRequestFactory(): RequestFactoryInterface
    {
        if ($this->requestFactory === null) {
            $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        }

        return $this->requestFactory;
    }

    /**
     * @param RequestFactoryInterface $requestFactory
     */
    public function setRequestFactory(RequestFactoryInterface $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * @return StreamFactoryInterface
     */
    public function getStreamFactory(): StreamFactoryInterface
    {
        if (null === $this->streamFactory) {
            $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        }

        return $this->streamFactory;
    }

    /**
     * @param StreamFactoryInterface $streamFactory
     */
    public function setStreamFactory(StreamFactoryInterface $streamFactory): void
    {
        $this->streamFactory = $streamFactory;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $apiKey
     * @return Client
     */
    public function buildClient(string $apiKey): Client
    {
        $configuration = Configuration::build($apiKey);

        list($resourceClient) = $this->setUpClient($configuration);

        return new Client(
            new ListApi($resourceClient),
            new PingApi($resourceClient)
        );
    }

    /**
     * @codeCoverageIgnore
     *
     * @param Configuration $configuration
     * @return array
     */
    private function setUpClient(Configuration $configuration): array
    {
        $uriGenerator = new UriGenerator($configuration->getBaseUri());
        $httpClient = new HttpClient(
            $this->getHttpClient(),
            $this->getRequestFactory(),
            $this->getStreamFactory()
        );
        $authenticatedHttpClient = new AuthenticatedClient($configuration, $httpClient);
        $resourceClient = new ResourceClient($authenticatedHttpClient, $uriGenerator);

        return [$resourceClient];
    }
}
