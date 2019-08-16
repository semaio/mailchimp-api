<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Api;

interface PingApiInterface
{
    /**
     * @return array
     */
    public function execute(): array;
}
