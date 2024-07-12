<?php

if ($argc < 3) {
    die('Not enough arguments').PHP_EOL;
}

$apiKey = $argv[1];
$outputLocation = $argv[2];

require __DIR__."/dependency_injection.php";

$converter = new PrestaShop\PSCurrenciesAPI\FixerIoConverter();
$converter->setApiClient(new PrestaShop\PSCurrenciesAPI\FixerIoApiClient($apiKey));
$writer = new PrestaShop\PSCurrenciesAPI\CurrenciesWriter($converter);

$return = $writer->execute($outputLocation);

exit($return);