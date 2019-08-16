<?php declare(strict_types=1);

namespace Semaio\MailchimpApi;

use Semaio\MailchimpApi\Api\ListApiInterface;
use Semaio\MailchimpApi\Api\PingApiInterface;

/**
 * Interface ClientInterface
 */
interface ClientInterface
{
    /**
     * @return ListApiInterface
     */
    public function getListApi(): ListApiInterface;

    /**
     * @return PingApiInterface
     */
    public function getPingApi(): PingApiInterface;
}
