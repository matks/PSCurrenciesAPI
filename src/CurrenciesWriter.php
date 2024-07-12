<?php

namespace PrestaShop\PSCurrenciesAPI;

class CurrenciesWriter
{
    const BASE_CURRENCY = 'EUR';

    private $converter;
    private $baseCurrency = self::BASE_CURRENCY;

    public function __construct(ConverterInterface $converter)
    {
        $this->converter = $converter;
    }

    /**
     * @param string $outputLocation
     *
     * @return int Error code
     */
    public function execute(string $outputLocation)
    {
        try {
            $this->converter->setBaseCurrency($this->baseCurrency);
            $this->writeCurrencies($this->converter->getRates(), $outputLocation);
        } catch (Exception $e) {
            return 1;
        }
        
        return 0;
    }

    /**
     * @param float[] $rates indexed by currency code
     * @param string $outputLocation
     *
     * @throws Exception
     */
    private function writeCurrencies($rates, $outputLocation)
    {
        $xmlString = '<?xml version="1.0" encoding="UTF-8"?><currencies><source iso_code="'.$this->baseCurrency.'" /></currencies>';
        $xml = new \SimpleXMLElement($xmlString);

        $listNode = $xml->addChild('list');

        foreach ($rates as $isoCode => $rate) {
            $currency = $listNode->addChild('currency');
            $currency->addAttribute('iso_code', $isoCode);
            $currency->addAttribute('rate', $rate);
        }

        $dom = dom_import_simplexml($xml)->ownerDocument;
        $dom->formatOutput = true;

        $xmlErrors = libxml_get_errors();
        if (0 > count($xmlErrors)) {
            $errorMessage = 'XML Errors have been found:'.PHP_EOL;
            foreach ($xmlErrors as $error) {
                $errorMessage .= $error->message;
            }

            throw new Exception($errorMessage);
        }

        fwrite(fopen($outputLocation, 'w'), $dom->saveXML());
    }
}