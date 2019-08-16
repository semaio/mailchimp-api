<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Semaio\MailchimpApi\Api\ListApiInterface;
use Semaio\MailchimpApi\Api\PingApiInterface;
use Semaio\MailchimpApi\Client;
use Semaio\MailchimpApi\ClientInterface;

/**
 * Class UriGeneratorTest
 */
class ClientTest extends TestCase
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ListApiInterface|MockObject
     */
    private $listApi;

    /**
     * @var PingApiInterface|MockObject
     */
    private $pingApi;

    protected function setUp(): void
    {
        $this->listApi = $this->createMock(ListApiInterface::class);
        $this->pingApi = $this->createMock(PingApiInterface::class);

        $this->client = new Client(
            $this->listApi,
            $this->pingApi
        );
    }

    public function testGetListApi()
    {
        $this->assertSame($this->listApi, $this->client->getListApi());
    }

    public function testGetPingApi()
    {
        $this->assertSame($this->pingApi, $this->client->getPingApi());
    }
}
