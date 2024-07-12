<?php

namespace PrestaShop\PSCurrenciesAPI;

interface ConverterInterface
{
    public function setBaseCurrency($baseCurrency);
    public function getRates();
}