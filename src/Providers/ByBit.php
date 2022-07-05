<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */

namespace EvolutionScript\CryptocurrencyAPI\Providers;


use GuzzleHttp\Client;

class ByBit implements Provider
{
	private $api_url = 'https://api.bybit.com/v2/public/tickers?symbol=';
	public function rate($base, $to)
	{
		$pair = $base.$to;
		$client = new Client();
		$resp = $client->get($this->api_url.$pair);
		if($resp->getStatusCode() != 200){
			throw new \Exception('Could not connect with ByBit.');
		}
		$result = $resp->getBody();
		$result = json_decode($result);
		if(!isset($result->result[0]->last_price)){
			throw new \Exception('ByBit Error: could not retrieve pair value.');
		}
		return $result->result[0]->last_price;
	}
}