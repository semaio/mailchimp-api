<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests\Api;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Semaio\MailchimpApi\Api\PingApi;
use Semaio\MailchimpApi\Client\ResourceClientInterface;

/**
 * Class PingApiTest
 */
class PingApiTest extends TestCase
{
    /**
     * @var ResourceClientInterface|MockObject
     */
    protected $resourceClient;

    /**
     * @var PingApi
     */
    protected $pingApi;

    protected function setUp(): void
    {
        $this->resourceClient = $this->createMock(ResourceClientInterface::class);
        $this->pingApi = new PingApi($this->resourceClient);
    }

    public function testExecute()
    {
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('ping', [], [])
            ->willReturn($response);

        $this->assertEquals($response, $this->pingApi->execute());
    }
}
