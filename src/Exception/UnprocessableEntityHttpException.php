<?php
declare(strict_types=1);

namespace Semaio\MailchimpApi\Exception;

/**
 * Class UnprocessableEntityHttpException
 */
class UnprocessableEntityHttpException extends ClientErrorHttpException
{
    /**
     * Returns the response errors if there are any
     */
    public function getResponseErrors(): array
    {
        $responseBody = $this->response->getBody();
        $responseBody->rewind();
        $decodedBody = json_decode($responseBody->getContents(), true);
        $responseBody->rewind();

        return isset($decodedBody['errors']) ? $decodedBody['errors'] : [];
    }
}
