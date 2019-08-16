<?php
declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Semaio\MailchimpApi\ClientBuilder;

/**
 * Class ClientBuilderTest
 */
class ClientBuilderTest extends TestCase
{
    /**
     * @var ClientInterface|MockObject
     */
    protected $httpClient;

    /**
     * @var RequestFactoryInterface|MockObject
     */
    protected $requestFactory;

    /**
     * @var StreamFactoryInterface|MockObject
     */
    protected $streamFactory;

    /**
     * @var ClientBuilder
     */
    protected $clientBuilder;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->requestFactory = $this->createMock(RequestFactoryInterface::class);
        $this->streamFactory = $this->createMock(StreamFactoryInterface::class);

        $this->clientBuilder = new ClientBuilder();
    }

    public function testGetHttpClientFromDiscovery()
    {
        $this->assertNotSame($this->httpClient, $this->clientBuilder->getHttpClient());
    }

    public function testGetHttpClient()
    {
        $this->clientBuilder->setHttpClient($this->httpClient);
        $this->assertSame($this->httpClient, $this->clientBuilder->getHttpClient());
    }

    public function testGetRequestFactoryFromDiscovery()
    {
        $this->assertNotSame($this->requestFactory, $this->clientBuilder->getRequestFactory());
    }

    public function testGetRequestFactory()
    {
        $this->clientBuilder->setRequestFactory($this->requestFactory);
        $this->assertSame($this->requestFactory, $this->clientBuilder->getRequestFactory());
    }

    public function testGetStreamFactoryFromDiscovery()
    {
        $this->assertNotSame($this->streamFactory, $this->clientBuilder->getStreamFactory());
    }

    public function testGetStreamFactory()
    {
        $this->clientBuilder->setStreamFactory($this->streamFactory);
        $this->assertSame($this->streamFactory, $this->clientBuilder->getStreamFactory());
    }
}
