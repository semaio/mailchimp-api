<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Client;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

/**
 * Interface HttpClientInterface
 */
interface HttpClientInterface
{
    /**
     * @param string                      $httpMethod
     * @param string|UriInterface         $uri
     * @param array                       $headers
     * @param string|StreamInterface|null $body
     * @return ResponseInterface
     */
    public function sendRequest(string $httpMethod, $uri, array $headers = [], $body = null): ResponseInterface;
}
