<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Tests\Routing;

use PHPUnit\Framework\TestCase;
use Semaio\MailchimpApi\Routing\UriGenerator;

/**
 * Class UriGeneratorTest
 */
class UriGeneratorTest extends TestCase
{
    public function testGenerate()
    {
        $uriGenerator = new UriGenerator('http://example.org');

        $this->assertEquals(
            'http://example.org/path/param1/param2?query1=value1&query2=value2',
            $uriGenerator->generate(
                'path/%s/%s',
                ['param1', 'param2'],
                ['query1' => 'value1', 'query2' => 'value2']
            )
        );
    }
}
