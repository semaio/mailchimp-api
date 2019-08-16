<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Client;

/**
 * Interface ResourceClientInterface
 */
interface ResourceClientInterface
{
    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_PATCH = 'PATCH';
    const HTTP_METHOD_PUT = 'PUT';
    const HTTP_METHOD_DELETE = 'DELETE';

    /**
     * @param string $uri
     * @param array  $uriParameters
     * @param array  $queryParameters
     * @return array
     */
    public function getResource(string $uri, array $uriParameters = [], array $queryParameters = []): array;

    /**
     * @param string $uri
     * @param array  $uriParameters
     * @param array  $body
     * @return array
     */
    public function createResource(string $uri, array $uriParameters = [], array $body = []): array;

    /**
     * @param string $uri
     * @param array  $uriParameters
     * @param array  $body
     * @return array
     */
    public function updateResource(string $uri, array $uriParameters = [], array $body = []): array;

    /**
     * @param string $uri
     * @param array  $uriParameters
     * @param array  $body
     * @return array
     */
    public function upsertResource(string $uri, array $uriParameters = [], array $body = []): array;

    /**
     * @param string $uri
     * @param array  $uriParameters
     * @return array
     */
    public function deleteResource(string $uri, array $uriParameters = []): array;
}
