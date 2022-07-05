<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */

namespace EvolutionScript\CryptocurrencyAPI\Providers;


use GuzzleHttp\Client;

class Gemini implements Provider
{
	private $api_url = 'https://api.gemini.com/v1/pubticker/';
	public function rate($base, $to)
	{
		$pair = $base.$to;
		$client = new Client();
		$resp = $client->get($this->api_url.$pair);
		if($resp->getStatusCode() != 200){
			throw new \Exception('Could not connect with Gemini.');
		}
		$result = $resp->getBody();
		$result = json_decode($result);
		if(!isset($result->last)){
			throw new \Exception('Gemini Error: could not retrieve pair value.');
		}
		return $result->last;
	}
}