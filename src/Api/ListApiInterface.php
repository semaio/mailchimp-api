<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Api;

interface ListApiInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function createList(array $data): array;

    /**
     * @param string $listId
     * @param array  $data
     * @return array
     */
    public function createMembers(string $listId, array $data): array;

    /**
     * @param string $listId
     * @param array  $data
     * @return array
     */
    public function createMember(string $listId, array $data): array;

    /**
     * @param string $listId
     * @param array  $parameters
     * @return array
     */
    public function getMembers(string $listId, array $parameters = []): array;

    /**
     * @param string $listId
     * @param string $email
     * @param array  $parameters
     * @return array
     */
    public function getMember(string $listId, string $email, array $parameters = []): array;

    /**
     * @param string $listId
     * @param string $email
     * @param array  $data
     * @return array
     */
    public function updateMember(string $listId, string $email, array $data): array;

    /**
     * @param string $listId
     * @param string $email
     * @param array  $data
     * @return array
     */
    public function upsertMember(string $listId, string $email, array $data): array;

    /**
     * @param string $listId
     * @param string $email
     * @return array
     */
    public function deleteMember(string $listId, string $email): array;

    /**
     * @param string $email
     * @return string
     */
    public function getSubscriberHash(string $email): string;
}
