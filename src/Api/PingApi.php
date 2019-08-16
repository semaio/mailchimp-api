<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Api;

use Semaio\MailchimpApi\Client\ResourceClientInterface;

class PingApi implements PingApiInterface
{
    /**
     * @var ResourceClientInterface
     */
    private $resourceClient;

    /**
     * PingApi constructor.
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
    public function execute(): array
    {
        return $this->resourceClient->getResource('ping', [], []);
    }
}
