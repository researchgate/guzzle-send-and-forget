<?php
namespace rg\saf;

use Psr\Http\Message\RequestInterface;

/**
 * @copyright ResearchGate GmbH
 */
class GuzzleRequestParser implements RequestParser {

    /**
     * @param RequestInterface $request
     *
     * @return string
     */
    public function parse(RequestInterface $request): string {
        return \GuzzleHttp\Psr7\str($request);
    }
}
