<?php
namespace rg\guzzle;

use Psr\Http\Message\RequestInterface;

/**
 * @copyright ResearchGate GmbH
 */
class Client {
    /**
     * @var \Resource
     */
    private $fp;

    /**
     * @param RequestParser $requestParser
     */
    public function __construct(RequestParser $requestParser = null) {
        if (!$requestParser) {
            $requestParser = new GuzzleRequestParser();
        }
        $this->requestParser = $requestParser;
    }

    /**
     * @param RequestInterface $request
     *
     * @throws ConnectionException
     */
    public function sendAndForget(RequestInterface $request) {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Content-Length' => strlen((string) $request->getBody()),
        ];

        foreach ($headers as $headerName => $headerValue) {
            $request = $request->withHeader($headerName, $headerValue);
        }

        $uri = $request->getUri();
        $requestString = $this->requestParser->parse($request);

        if (!$this->fp || !(is_resource($this->fp))) {
            $this->fp = stream_socket_client('tcp://' . $uri->getHost() . ':' . $uri->getPort(), $errno, $errstr);

            if (!$this->fp) {
                throw new ConnectionException(
                    sprintf(
                        'Could not connect host. Host: %s, port: %s, error number: %s, error: %s',
                        $uri->getHost(),
                        $uri->getPort(),
                        $errno,
                        $errstr
                    )
                );
            }
        }
        fwrite($this->fp, $requestString);
    }
}
