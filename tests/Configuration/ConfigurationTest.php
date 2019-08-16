<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests\Configuration;

use PHPUnit\Framework\TestCase;
use Semaio\MailchimpApi\Configuration\Configuration;
use Semaio\MailchimpApi\Exception\InvalidApiKeyException;

class ConfigurationTest extends TestCase
{
    public function testBuild()
    {
        $apiKey = 'phpunit-dc';

        $configuration = Configuration::build($apiKey);

        $this->assertEquals('https://dc.api.mailchimp.com/3.0', $configuration->getBaseUri());
        $this->assertEquals($apiKey, $configuration->getApiKey());
    }

    public function testBuildWithInvalidApiKey()
    {
        $this->expectException(InvalidApiKeyException::class);

        Configuration::build('phpunit');
    }
}
