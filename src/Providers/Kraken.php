<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */

namespace EvolutionScript\CryptocurrencyAPI\Providers;


use GuzzleHttp\Client;

class Kraken implements Provider
{
	private $api_url = 'https://api.kraken.com/0/public/Ticker?pair=';
	public function rate($base, $to)
	{
		$pair = $base.$to;
		$client = new Client();
		$resp = $client->get($this->api_url.$pair);
		if($resp->getStatusCode() != 200){
			throw new \Exception('Could not connect with Kraken.');
		}
		$result = $resp->getBody();
		$result = json_decode($result);
		if(!isset($result->result)){
			throw new \Exception('Kraken Error: could not retrieve pair value.');
		}
		$result = (array) $result->result;
		$result = array_values($result);
		if(!isset($result[0]->a[0])){
			throw new \Exception('Kraken Error: could not retrieve pair value.');
		}
		return $result[0]->a[0];
	}
}