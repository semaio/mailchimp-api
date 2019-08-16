<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Api;

use Semaio\MailchimpApi\Client\ResourceClientInterface;

class ListApi implements ListApiInterface
{
    /**
     * @var ResourceClientInterface
     */
    private $resourceClient;

    /**
     * ListApi constructor.
     *
     * @param ResourceClientInterface $resourceClient
     */
    public function __construct(ResourceClientInterface $resourceClient)
    {
        $this->resourceClient = $resourceClient;
    }

    /**
     * @inheritDoc
     */
    public function createList(array $data): array
    {
        return $this->resourceClient->createResource('lists', [], $data);
    }

    /**
     * @inheritDoc
     */
    public function createMembers(string $listId, array $data): array
    {
        return $this->resourceClient->createResource('lists/%s', [$listId], $data);
    }

    /**
     * @inheritDoc
     */
    public function createMember(string $listId, array $data): array
    {
        return $this->resourceClient->createResource('lists/%s/members', [$listId], $data);
    }

    /**
     * @inheritDoc
     */
    public function getMembers(string $listId, array $parameters = []): array
    {
        return $this->resourceClient->getResource('lists/%s/members', [$listId], $parameters);
    }

    /**
     * @inheritDoc
     */
    public function getMember(string $listId, string $email, array $parameters = []): array
    {
        return $this->resourceClient->getResource(
            'lists/%s/members/%s',
            [$listId, $this->getSubscriberHash($email)],
            $parameters
        );
    }

    /**
     * @inheritDoc
     */
    public function updateMember(string $listId, string $email, array $data): array
    {
        return $this->resourceClient->updateResource(
            'lists/%s/members/%s',
            [$listId, $this->getSubscriberHash($email)],
            $data
        );
    }

    /**
     * @inheritDoc
     */
    public function upsertMember(string $listId, string $email, array $data): array
    {
        return $this->resourceClient->upsertResource(
            'lists/%s/members/%s',
            [$listId, $this->getSubscriberHash($email)],
            $data
        );
    }

    /**
     * @inheritDoc
     */
    public function deleteMember(string $listId, string $email): array
    {
        return $this->resourceClient->deleteResource(
            'lists/%s/members/%s',
            [$listId, $this->getSubscriberHash($email)]
        );
    }

    /**
     * @inheritDoc
     */
    public function getSubscriberHash(string $email): string
    {
        return md5(strtolower($email));
    }
}
