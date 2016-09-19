<?php
namespace rg\guzzle;

use Psr\Http\Message\RequestInterface;

/**
 * @copyright ResearchGate GmbH
 */
interface RequestParser {

    /**
     * @param RequestInterface $request
     *
     * @return string
     */
    public function parse(RequestInterface $request): string;
}
