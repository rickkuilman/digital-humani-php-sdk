<?php

namespace Rickkuilman\DigitalHumaniPhpSdk;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Rickkuilman\DigitalHumaniPhpSdk\Exceptions\ForbiddenException;
use Rickkuilman\DigitalHumaniPhpSdk\Exceptions\NotFoundException;
use Rickkuilman\DigitalHumaniPhpSdk\Exceptions\UnauthorizedException;
use Rickkuilman\DigitalHumaniPhpSdk\Exceptions\BadRequestException;

trait MakesHttpRequests
{
    /**
     * Make a GET request to Digital Humani servers and return the response.
     *
     * @param string $uri
     * @return mixed
     * @throws Exception
     */
    public function get(string $uri)
    {
        return $this->request('GET', $uri);
    }

    /**
     * Make a POST request to Digital Humani servers and return the response.
     *
     * @param string $uri
     * @param array $payload
     * @return mixed
     * @throws Exception
     */
    public function post(string $uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Make request to Digital Humani servers and return the response.
     *
     * @param string $verb
     * @param string $uri
     * @param array $payload
     * @return mixed
     * @throws Exception
     */
    protected function request(string $verb, string $uri, array $payload = [])
    {
        $response = $this->guzzle->request($verb, $uri,
            empty($payload) ? [] : ['json' => $payload]
        );

        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode > 299) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string)$response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    /**
     * Handle the request error.
     *
     * @param ResponseInterface $response
     * @return void
     *
     * @throws Exception
     * @throws NotFoundException
     */
    protected function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 403) {
            throw new ForbiddenException();
        }

        if ($response->getStatusCode() == 404) {
            throw new NotFoundException();
        }

        if ($response->getStatusCode() == 401) {
            throw new UnauthorizedException($this);
        }

        if ($response->getStatusCode() == 400) {
            throw new BadRequestException((string)$response->getBody());
        }

        throw new Exception((string)$response->getBody());
    }

}
