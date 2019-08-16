<?php
declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests\Exception;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Semaio\MailchimpApi\Exception\HttpException;

/**
 * Class HttpExceptionTest
 */
class HttpExceptionTest extends TestCase
{
    /**
     * @var RequestInterface|MockObject
     */
    protected $request;

    /**
     * @var ResponseInterface|MockObject
     */
    protected $response;

    /**
     * @var HttpException
     */
    protected $httpException;

    protected function setUp(): void
    {
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(500);

        $this->httpException = new HttpException(
            'message',
            $this->request,
            $this->response
        );
    }

    public function testGetRequest()
    {
        $this->assertSame($this->request, $this->httpException->getRequest());
    }

    public function testGetResponse()
    {
        $this->assertSame($this->response, $this->httpException->getResponse());
    }
}
