<?php

namespace PrestaShop\PSCurrenciesAPI;

class FixerIoApiClient
{
    /**
     * @var string
     */
    private $apiKey;

    /* Endpoint is http because https is not available for free plan */
    const CONVERTER_URL = 'http://data.fixer.io/api/latest?access_key=%s';

    /**
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiResponse()
    {
		$url = sprintf(self::CONVERTER_URL, $this->apiKey);
        
        $response = file_get_contents($url);

        return $response;
    }
}