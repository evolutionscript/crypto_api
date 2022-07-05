<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */

namespace EvolutionScript\CryptocurrencyAPI\Providers;


use GuzzleHttp\Client;

class Bittrex implements Provider
{
	private $api_url = 'https://api.bittrex.com/v3/markets/{pair}/ticker';
	public function rate($base, $to)
	{
		$pair = $base.'-'.$to;
		$api_url = str_replace('{pair}', $pair, $this->api_url);
		$client = new Client();
		$resp = $client->get($api_url);
		if($resp->getStatusCode() != 200){
			throw new \Exception('Could not connect with Bittrex.');
		}
		$result = $resp->getBody();
		$result = json_decode($result);
		if(!isset($result->lastTradeRate)){
			throw new \Exception('Bittrex Error: could not retrieve pair value.');
		}
		return $result->lastTradeRate;
	}
}