<?php declare(strict_types=1);

namespace Semaio\MailchimpApi;

use Semaio\MailchimpApi\Api\ListApiInterface;
use Semaio\MailchimpApi\Api\PingApiInterface;

class Client implements ClientInterface
{
    /**
     * @var ListApiInterface
     */
    private $listApi;

    /**
     * @var PingApiInterface
     */
    private $pingApi;

    /**
     * Client constructor.
     *
     * @param ListApiInterface $listApi
     * @param PingApiInterface $pingApi
     */
    public function __construct(ListApiInterface $listApi, PingApiInterface $pingApi)
    {
        $this->listApi = $listApi;
        $this->pingApi = $pingApi;
    }

    /**
     * @return ListApiInterface
     */
    public function getListApi(): ListApiInterface
    {
        return $this->listApi;
    }

    /**
     * @return PingApiInterface
     */
    public function getPingApi(): PingApiInterface
    {
        return $this->pingApi;
    }
}
