<?php
declare(strict_types=1);

namespace Semaio\MailchimpApi\Exception;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpException
 */
class HttpException extends RuntimeException
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * HttpException constructor.
     *
     * @param string            $message
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param Exception|null    $previous
     */
    public function __construct(
        string $message,
        RequestInterface $request,
        ResponseInterface $response,
        ?Exception $previous = null
    ) {
        parent::__construct($message, $response->getStatusCode(), $previous);

        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
