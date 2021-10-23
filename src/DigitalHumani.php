<?php

namespace Rickkuilman\DigitalHumaniPhpSdk;

use GuzzleHttp\Client as HttpClient;
use Rickkuilman\DigitalHumaniPhpSdk\Actions\ManagesEnterprises;
use Rickkuilman\DigitalHumaniPhpSdk\Actions\ManagesProjects;
use Rickkuilman\DigitalHumaniPhpSdk\Actions\ManagesTrees;
use Rickkuilman\DigitalHumaniPhpSdk\Resources\Enterprise;

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
     * Base URL of Digital Humani
     *
     * @var string
     */
    public string $baseUrl;

    /**
     * @var string|null
     */
    public ?string $enterpriseId = null;

    /**
     * Create a new Forge instance.
     *
     * @param string|null $apiKey
     * @param HttpClient|null $guzzle
     * @return void
     */
    public function __construct(string $apiKey = null, string $defaultEnterpriseId = null, bool $useProduction = false, HttpClient $guzzle = null)
    {
        $this->useProductionEnvironment($useProduction);

        if (!is_null($defaultEnterpriseId)) {
            $this->setEnterprise($defaultEnterpriseId);
        }

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

        $this->guzzle = $guzzle ?: new HttpClient([
            'base_uri' => $this->baseUrl,
            'http_errors' => false,
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
        return self::DEFAULT_PROJECT_ID;
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

    /**
     * Use the production environment
     *
     * @param bool $useProduction
     */
    public function useProductionEnvironment(bool $useProduction = true)
    {
        $useProduction
            ? $this->setBaseUrl(self::PRODUCTION_URL)
            : $this->useSandboxEnvironment();
    }

    /**
     * Use the sandbox environment
     *
     * @param bool $useSandbox
     */
    public function useSandboxEnvironment(bool $useSandbox = true)
    {
        $useSandbox
            ? $this->setBaseUrl(self::SANDBOX_URL)
            : $this->useProductionEnvironment();
    }

    /**
     * Set the base url
     *
     * @param string $baseUrl
     */
    public function setBaseUrl(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Set enterprise by id or instance
     *
     * @param string|Enterprise $enterprise
     */
    public function setEnterprise($enterprise)
    {
        $this->enterpriseId = $enterprise instanceof Enterprise
            ? $enterprise->id
            : $enterprise;
    }

    /**
     * @return string|null
     */
    public function getDefaultEnterpriseId(): ?string
    {
        return $this->enterpriseId;
    }

    /**
     * Returns whether the production environment is used.
     *
     * @return bool
     */
    public function usesProductionEnvironment(): bool
    {
        return $this->baseUrl === self::PRODUCTION_URL;
    }

}

