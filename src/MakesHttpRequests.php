<?php

namespace Rickkuilman\DigitalHumaniPhpSdk;

use Exception;

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


        $responseBody = (string)$response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

}
