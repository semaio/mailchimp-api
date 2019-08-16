<?php
declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests\Client;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Semaio\MailchimpApi\Client\HttpExceptionHandler;
use Semaio\MailchimpApi\Exception\BadRequestHttpException;
use Semaio\MailchimpApi\Exception\ClientErrorHttpException;
use Semaio\MailchimpApi\Exception\NotFoundHttpException;
use Semaio\MailchimpApi\Exception\RedirectionHttpException;
use Semaio\MailchimpApi\Exception\ServerErrorHttpException;
use Semaio\MailchimpApi\Exception\UnauthorizedHttpException;
use Semaio\MailchimpApi\Exception\UnprocessableEntityHttpException;

/**
 * Class HttpExceptionHandlerTest
 */
class HttpExceptionHandlerTest extends TestCase
{
    /**
     * @var HttpExceptionHandler
     */
    protected $httpExceptionHandler;

    /**
     * @var RequestInterface|MockObject
     */
    protected $request;

    /**
     * @var ResponseInterface|MockObject
     */
    protected $response;

    protected function setUp(): void
    {
        $this->httpExceptionHandler = new HttpExceptionHandler();
        $this->request = $this->createMock(RequestInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
    }

    public function testHandleThrowsRedirectionHttpException()
    {
        $this->expectException(RedirectionHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(300);

        /** @var StreamInterface|MockObject $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    public function testHandleThrowsBadRequestHttpException()
    {
        $this->expectException(BadRequestHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(400);

        /** @var StreamInterface|MockObject $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    public function testHandleThrowsUnauthorizedHttpException()
    {
        $this->expectException(UnauthorizedHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(401);

        /** @var StreamInterface|MockObject $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    public function testHandleThrowsNotFoundHttpException()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(404);

        /** @var StreamInterface|MockObject $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    public function testHandleThrowsUnprocessableEntityHttpException()
    {
        $this->expectException(UnprocessableEntityHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(422);

        /** @var StreamInterface|MockObject $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    public function testHandleThrowsClientErrorHttpException()
    {
        $this->expectException(ClientErrorHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(429);

        /** @var StreamInterface|MockObject $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }

    public function testHandleThrowsServerErrorHttpException()
    {
        $this->expectException(ServerErrorHttpException::class);

        $this->response->expects($this->any())
            ->method('getStatusCode')
            ->willReturn(500);

        /** @var StreamInterface|MockObject $stream */
        $stream = $this->createMock(StreamInterface::class);

        $this->response->expects($this->any())
            ->method('getBody')
            ->willReturn($stream);

        $stream->expects($this->once())
            ->method('getContents')
            ->willReturn('contents');

        $this->response->expects($this->once())
            ->method('getReasonPhrase')
            ->willReturn('reason');

        $this->httpExceptionHandler->handle($this->request, $this->response);
    }
}
