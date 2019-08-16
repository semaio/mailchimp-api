<?php
declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests\Client;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Semaio\MailchimpApi\Client\AuthenticatedClient;
use Semaio\MailchimpApi\Client\HttpClientInterface;
use Semaio\MailchimpApi\Configuration\Configuration;

/**
 * Class AuthenticatedClientTest
 */
class AuthenticatedClientTest extends TestCase
{
    /**
     * @var Configuration|MockObject
     */
    protected $configuration;

    /**
     * @var HttpClientInterface|MockObject
     */
    protected $client;

    /**
     * @var AuthenticatedClient
     */
    protected $authenticatedClient;

    protected function setUp(): void
    {
        $this->configuration = $this->createMock(Configuration::class);
        $this->client = $this->createMock(HttpClientInterface::class);

        $this->authenticatedClient = new AuthenticatedClient(
            $this->configuration,
            $this->client
        );
    }

    public function testSendRequest()
    {
        $uri = 'lists';

        $apiKey = 'phpunit-dc';
        $httpMethod = 'GET';

        /** @var MockObject|ResponseInterface $response */
        $response = $this->createMock(ResponseInterface::class);

        $this->configuration->expects($this->once())
            ->method('getApiKey')
            ->willReturn($apiKey);

        $this->client->expects($this->once())
            ->method('sendRequest')
            ->with(
                $httpMethod,
                $uri,
                ['Authorization' => 'apikey ' . $apiKey],
                null
            )->willReturn($response);

        $this->assertEquals(
            $response,
            $this->authenticatedClient->sendRequest(
                $httpMethod,
                $uri
            )
        );
    }
}
