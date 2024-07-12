<?php

require __DIR__."/../dependency_injection.php";
require __DIR__."/MockApiClient.php";

// test 2

$apiResponse1 = file_get_contents(__DIR__.'/api-response-2.json');

$converter = new PrestaShop\PSCurrenciesAPI\FixerIoConverter();
$converter->setApiClient(new PrestaShopTests\MockApiClient($apiResponse1));
$writer = new PrestaShop\PSCurrenciesAPI\CurrenciesWriter($converter);

$return = $writer->execute(__DIR__.'/output/converter-output-2.xml');

// verify test 1 output

$file1 = file_get_contents(__DIR__.'/output/converter-output-2.xml');
$file2= file_get_contents(__DIR__.'/expected-output-2.xml');

if ($file1 !== $file2) {
	echo 'Error test case 2 : output is different from expected'.PHP_EOL;
	exit(1);
}

exit(0);
