<?php
declare(strict_types=1);

namespace Semaio\MailchimpApi\Configuration;

use Semaio\MailchimpApi\Exception\InvalidApiKeyException;

/**
 * Class Configuration
 */
class Configuration
{
    /**
     * @var string
     */
    private $defaultBaseUri = 'https://<dc>.api.mailchimp.com/3.0';

    /**
     * @var string
     */
    private $baseUri;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * Configuration constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        if (strpos($apiKey, '-') === false) {
            throw new InvalidApiKeyException();
        }

        $dataCenter = explode('-', $apiKey)[1];
        $baseUri = str_replace('<dc>', $dataCenter, $this->defaultBaseUri);

        $this->baseUri = $baseUri;
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     * @return Configuration
     */
    public static function build(string $apiKey): self
    {
        return new static($apiKey);
    }
}
