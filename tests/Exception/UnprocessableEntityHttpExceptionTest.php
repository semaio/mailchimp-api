<?php
declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests\Exception;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Semaio\MailchimpApi\Exception\UnprocessableEntityHttpException;

/**
 * Class UnprocessableEntityHttpExceptionTest
 */
class UnprocessableEntityHttpExceptionTest extends TestCase
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
     * @var UnprocessableEntityHttpException
     */
    protected $unprocessableEntityHttpException;

    protected function setUp(): void
    {
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(500);

        $this->unprocessableEntityHttpException = new UnprocessableEntityHttpException(
            'message',
            $this->request,
            $this->response
        );
    }

    public function testGetResponseErrors()
    {
        /** @var MockObject|StreamInterface $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->any())
            ->method('rewind')
            ->willReturnSelf();

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode(['contents']));

        $this->unprocessableEntityHttpException->getResponseErrors();
    }
}
