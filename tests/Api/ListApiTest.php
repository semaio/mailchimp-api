<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests\Api;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Semaio\MailchimpApi\Api\ListApi;
use Semaio\MailchimpApi\Client\ResourceClientInterface;

/**
 * Class ListApiTest
 */
class ListApiTest extends TestCase
{
    /**
     * @var ResourceClientInterface|MockObject
     */
    protected $resourceClient;

    /**
     * @var ListApi
     */
    protected $listApi;

    protected function setUp(): void
    {
        $this->resourceClient = $this->createMock(ResourceClientInterface::class);
        $this->listApi = new ListApi($this->resourceClient);
    }

    public function testCreateList()
    {
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('lists', [], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->listApi->createList($data));
    }

    public function testCreateMembers()
    {
        $listId = '12345';
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('lists/%s', [$listId], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->listApi->createMembers($listId, $data));
    }

    public function testCreateMember()
    {
        $listId = '12345';
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('createResource')
            ->with('lists/%s/members', [$listId], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->listApi->createMember($listId, $data));
    }

    public function testGetMembers()
    {
        $listId = '12345';
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('lists/%s/members', [$listId], [])
            ->willReturn($response);

        $this->assertEquals($response, $this->listApi->getMembers($listId));
    }

    public function testGetMember()
    {
        $email = 'email';
        $listId = '12345';
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('getResource')
            ->with('lists/%s/members/%s', [$listId, md5($email)], [])
            ->willReturn($response);

        $this->assertEquals($response, $this->listApi->getMember($listId, $email));
    }

    public function testUpdateMember()
    {
        $email = 'email';
        $listId = '12345';
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('updateResource')
            ->with('lists/%s/members/%s', [$listId, md5($email)], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->listApi->updateMember($listId, $email, $data));
    }

    public function testUpsertMember()
    {
        $email = 'email';
        $listId = '12345';
        $data = ['data'];
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('upsertResource')
            ->with('lists/%s/members/%s', [$listId, md5($email)], $data)
            ->willReturn($response);

        $this->assertEquals($response, $this->listApi->upsertMember($listId, $email, $data));
    }

    public function testDeleteMember()
    {
        $email = 'email';
        $listId = '12345';
        $response = ['response'];

        $this->resourceClient->expects($this->once())
            ->method('deleteResource')
            ->with('lists/%s/members/%s', [$listId, md5($email)])
            ->willReturn($response);

        $this->assertEquals($response, $this->listApi->deleteMember($listId, $email));
    }

    public function testGetSubscriberHash()
    {
        $emailOne = $this->listApi->getSubscriberHash('Foo.Bar@example.org');
        $emailTwo = $this->listApi->getSubscriberHash('foo.bar@example.org');

        $this->assertSame($emailOne, $emailTwo);
    }
}
