<?php

namespace Rickkuilman\DigitalHumaniSdk;

use GuzzleHttp\Client as HttpClient;
use Rickkuilman\DigitalHumaniSdk\Actions\ManagesEnterprises;
use Rickkuilman\DigitalHumaniSdk\Actions\ManagesProjects;
use Rickkuilman\DigitalHumaniSdk\Actions\ManagesTrees;

class DigitalHumani
{
    use MakesHttpRequests;
    use ManagesTrees;
    use ManagesEnterprises;
    use ManagesProjects;

    const DEFAULT_PROJECT_ID = '14442771';
    const SANDBOX_URL = 'https://api.sandbox.digitalhumani.com/';
    const PRODUCTION_URL = 'https://api.digitalhumani.com/';

    /**
     * The Digital Humani API Key.
     *
     * @var string
     */
    protected string $apiKey;

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var HttpClient
     */
    public HttpClient $guzzle;

    /**
     * Create a new Forge instance.
     *
     * @param string|null $apiKey
     * @param HttpClient|null $guzzle
     * @return void
     */
    public function __construct(string $apiKey = null, HttpClient $guzzle = null)
    {
        if (!is_null($apiKey)) {
            $this->setApiKey($apiKey, $guzzle);
        }

        if (!is_null($guzzle)) {
            $this->guzzle = $guzzle;
        }
    }

    /**
     * Set the api key and setup the guzzle request object.
     *
     * @param string $apiKey
     * @param HttpClient|null $guzzle
     * @return $this
     */
    public function setApiKey(string $apiKey, HttpClient $guzzle = null): DigitalHumani
    {
        $this->apiKey = $apiKey;

        $baseUrl = self::SANDBOX_URL;
        if (config('digital-humani.use_production')) {
            $baseUrl = self::PRODUCTION_URL;
        }

        $this->guzzle = $guzzle ?: new HttpClient([
            'base_uri' => $baseUrl,
            'headers' => [
                'X-Api-Key' => $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $this;
    }

    /**
     * Get the default project id
     *
     * @return string
     */
    protected function defaultProjectId(): string
    {
        return config('digital-humani.default_project') ?? self::DEFAULT_PROJECT_ID;
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param array $collection
     * @param string $class
     * @param array $extraData
     * @return array
     */
    protected function transformCollection(array $collection, $class, array $extraData = []): array
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }
}

