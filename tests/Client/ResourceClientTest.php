<?php declare(strict_types=1);

namespace Semaio\MailchimApi\Tests\Client;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Semaio\MailchimpApi\Client\HttpClientInterface;
use Semaio\MailchimpApi\Client\ResourceClient;
use Semaio\MailchimpApi\Routing\UriGeneratorInterface;

/**
 * Class ResourceClientTest
 */
class ResourceClientTest extends TestCase
{
    /**
     * @var HttpClientInterface|MockObject
     */
    protected $httpClient;

    /**
     * @var ResponseInterface|MockObject
     */
    protected $response;

    /**
     * @var StreamInterface|MockObject
     */
    protected $stream;

    /**
     * @var UriGeneratorInterface|MockObject
     */
    protected $uriGenerator;

    /**
     * @var ResourceClient
     */
    protected $resourceClient;

    protected function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->response = $this->createMock(ResponseInterface::class);
        $this->stream = $this->createMock(StreamInterface::class);
        $this->uriGenerator = $this->createMock(UriGeneratorInterface::class);

        $this->resourceClient = new ResourceClient(
            $this->httpClient,
            $this->uriGenerator
        );
    }

    public function testGetResource()
    {
        $uri = 'lists/%s/members';
        $uriParameters = ['12345'];
        $generatedUri = 'lists/12345/members';
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri, $uriParameters)
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'GET',
                $generatedUri,
                ['Accept' => 'application/json']
            )->willReturn($this->response);

        $this->assertEquals(
            $contents,
            $this->resourceClient->getResource($uri, $uriParameters)
        );
    }

    public function testCreateResource()
    {
        $uri = 'lists';
        $body = ['body'];
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri)
            ->willReturn($uri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'POST',
                $uri,
                ['Content-Type' => 'application/json'],
                json_encode($body)
            )->willReturn($this->response);

        $this->assertEquals(
            $contents,
            $this->resourceClient->createResource($uri, [], $body)
        );
    }

    public function testUpdateResource()
    {
        $uri = 'lists/%s/members/%s';
        $uriParameters = ['12345', 'subscriberHash'];
        $generatedUri = 'lists/12345/members/subscriberHash';
        $body = ['body'];
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri, $uriParameters)
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'PATCH',
                $generatedUri,
                ['Content-Type' => 'application/json'],
                json_encode($body)
            )->willReturn($this->response);

        $this->assertEquals(
            $contents,
            $this->resourceClient->updateResource($uri, $uriParameters, $body)
        );
    }

    public function testUpsertResource()
    {
        $uri = 'lists/%s/members/%s';
        $uriParameters = ['12345', 'subscriberHash'];
        $generatedUri = 'lists/12345/members/subscriberHash';
        $body = ['body'];
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri, $uriParameters)
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'PUT',
                $generatedUri,
                ['Content-Type' => 'application/json'],
                json_encode($body)
            )->willReturn($this->response);

        $this->assertEquals(
            $contents,
            $this->resourceClient->upsertResource($uri, $uriParameters, $body)
        );
    }

    public function testDeleteResource()
    {
        $uri = 'lists/%s/members/%s';
        $uriParameters = ['12345', 'subscriberHash'];
        $generatedUri = 'lists/12345/members/subscriberHash';
        $contents = ['contents'];

        $this->uriGenerator->expects($this->once())
            ->method('generate')
            ->with($uri, $uriParameters)
            ->willReturn($generatedUri);

        $this->response->expects($this->once())
            ->method('getBody')
            ->willReturn($this->stream);

        $this->stream->expects($this->once())
            ->method('getContents')
            ->willReturn(json_encode($contents));

        $this->httpClient->expects($this->once())
            ->method('sendRequest')
            ->with(
                'DELETE',
                $generatedUri,
                ['Accept' => 'application/json']
            )->willReturn($this->response);

        $this->assertEquals(
            $contents,
            $this->resourceClient->deleteResource($uri, $uriParameters)
        );
    }
}
