<?php
declare(strict_types=1);

namespace Semaio\MailchimpApi\Client;

use Semaio\MailchimpApi\Exception\BadRequestHttpException;
use Semaio\MailchimpApi\Exception\ClientErrorHttpException;
use Semaio\MailchimpApi\Exception\NotFoundHttpException;
use Semaio\MailchimpApi\Exception\RedirectionHttpException;
use Semaio\MailchimpApi\Exception\ServerErrorHttpException;
use Semaio\MailchimpApi\Exception\UnauthorizedHttpException;
use Semaio\MailchimpApi\Exception\UnprocessableEntityHttpException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpExceptionHandler
 */
class HttpExceptionHandler
{
    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        if ($response->getStatusCode() >= 300 && $response->getStatusCode() < 400) {
            throw new RedirectionHttpException($this->getReplyMessage($response), $request, $response);
        }

        if ($response->getStatusCode() === 400) {
            throw new BadRequestHttpException($this->getReplyMessage($response), $request, $response);
        }

        if ($response->getStatusCode() === 401) {
            throw new UnauthorizedHttpException($this->getReplyMessage($response), $request, $response);
        }

        if ($response->getStatusCode() === 404) {
            throw new NotFoundHttpException($this->getReplyMessage($response), $request, $response);
        }

        if ($response->getStatusCode() === 422) {
            throw new UnprocessableEntityHttpException($this->getReplyMessage($response), $request, $response);
        }

        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 500) {
            throw new ClientErrorHttpException($this->getReplyMessage($response), $request, $response);
        }

        if ($response->getStatusCode() >= 500 && $response->getStatusCode() < 600) {
            throw new ServerErrorHttpException($this->getReplyMessage($response), $request, $response);
        }

        return $response;
    }

    /**
     * @param ResponseInterface $response
     * @return string
     */
    private function getReplyMessage(ResponseInterface $response): string
    {
        $responseBody = $response->getBody();

        $responseBody->rewind();
        $decodedBody = json_decode($responseBody->getContents(), true);
        $responseBody->rewind();

        return isset($decodedBody['replyMessage']) ? $decodedBody['replyMessage'] : $response->getReasonPhrase();
    }
}
