<?php

namespace PrestaShop\PSCurrenciesAPI;

class FixerIoConverter implements ConverterInterface
{
    /**
     * @var string
     */
    private $baseCurrency;

    /**
     * @var string
     */
    private $apiClient;

    /**
     * @param string $apiKey
     */
    public function setBaseCurrency($baseCurrency)
    {
        $this->baseCurrency = $baseCurrency;
    }

    /**
     * @param $apiClient
     */
    public function setApiClient($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @return float[] Rates indexed by currency code
     * 
     * @throws Exception
     */
    public function getRates()
    {
        $response = $this->apiClient->getApiResponse();

        if (empty($response)) {
            throw new \Exception("Unable to load currencies from Fixer.io");
        }

        $content = json_decode($response, true);

        if (JSON_ERROR_NONE !== $lastError = json_last_error()) {
            throw new \Exception(sprintf("Unable to parse JSON from Fixer.io. Error code: %s", $lastError));
        }

        if (empty($content['success']) || false === $content['success']) {
            throw new \Exception("Fixer.io request returned success = false, maybe over API limit?");
        }

        if (empty($content['rates'])) {
            throw new \Exception("No currencies returned by Fixer.io!");
        }

        return $content['rates'];
    }
}