<?php declare(strict_types=1);

namespace Semaio\MailchimpApi\Routing;

/**
 * Class UriGeneratorInterface
 */
interface UriGeneratorInterface
{
    /**
     * @param string $path
     * @param array  $uriParameters
     * @param array  $queryParameters
     * @return string
     */
    public function generate(string $path, array $uriParameters = [], array $queryParameters = []): string;
}
