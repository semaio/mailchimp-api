<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Client;

use Semaio\MailchimpApi\Routing\UriGeneratorInterface;

/**
 * Class ResourceClient
 */
class ResourceClient implements ResourceClientInterface
{
    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var UriGeneratorInterface
     */
    private $uriGenerator;

    /**
     * ResourceClient constructor.
     *
     * @param HttpClientInterface   $httpClient
     * @param UriGeneratorInterface $uriGenerator
     */
    public function __construct(HttpClientInterface $httpClient, UriGeneratorInterface $uriGenerator)
    {
        $this->httpClient = $httpClient;
        $this->uriGenerator = $uriGenerator;
    }

    /**
     * @inheritDoc
     */
    public function getResource(string $uri, array $uriParameters = [], array $queryParameters = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters, $queryParameters);

        $response = $this->httpClient->sendRequest(
            static::HTTP_METHOD_GET,
            $uri,
            ['Accept' => 'application/json']
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function createResource(string $uri, array $uriParameters = [], array $body = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters);

        $response = $this->httpClient->sendRequest(
            static::HTTP_METHOD_POST,
            $uri,
            ['Content-Type' => 'application/json'],
            json_encode($body)
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function updateResource(string $uri, array $uriParameters = [], array $body = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters);

        $response = $this->httpClient->sendRequest(
            static::HTTP_METHOD_PATCH,
            $uri,
            ['Content-Type' => 'application/json'],
            json_encode($body)
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function upsertResource(string $uri, array $uriParameters = [], array $body = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters);

        $response = $this->httpClient->sendRequest(
            static::HTTP_METHOD_PUT,
            $uri,
            ['Content-Type' => 'application/json'],
            json_encode($body)
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function deleteResource(string $uri, array $uriParameters = []): array
    {
        $uri = $this->uriGenerator->generate($uri, $uriParameters);
        $response = $this->httpClient->sendRequest(
            static::HTTP_METHOD_DELETE,
            $uri,
            ['Accept' => 'application/json']
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
