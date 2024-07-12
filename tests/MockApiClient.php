<?php

namespace PrestaShopTests;

class MockApiClient
{
	private $response;

	public function __construct($response)
	{
		$this->response = $response;
	}

	public function getApiResponse()
	{
		return $this->response;
	}
}