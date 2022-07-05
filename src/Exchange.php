<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */
namespace EvolutionScript\CryptocurrencyAPI;

use EvolutionScript\CryptocurrencyAPI\Providers\Binance;
use EvolutionScript\CryptocurrencyAPI\Providers\Bitfinex;
use EvolutionScript\CryptocurrencyAPI\Providers\Bittrex;
use EvolutionScript\CryptocurrencyAPI\Providers\ByBit;
use EvolutionScript\CryptocurrencyAPI\Providers\Gemini;
use EvolutionScript\CryptocurrencyAPI\Providers\Kraken;
use EvolutionScript\CryptocurrencyAPI\Providers\Kucoin;

class Exchange
{
	public function rate($base,$to)
	{
		try{
			$binance = new Binance();
			return $binance->rate($base,$to);
		}catch (\Exception $exception){
			try{
				$gemini = new Gemini();
				return $gemini->rate($base,$to);
			}catch (\Exception $exception){
				try{
					$kraken = new Kraken();
					return $kraken->rate($base,$to);
				}catch (\Exception $exception){
					try{
						$kucoin = new Kucoin();
						return $kucoin->rate($base,$to);
					}catch (\Exception $exception){
						try{
							$bybit = new ByBit();
							return $bybit->rate($base,$to);
						}catch (\Exception $exception){
							try{
								$bittrex = new Bittrex();
								return $bittrex->rate($base,$to);
							}catch (\Exception $exception){
								try{
									$bitfinex = new Bitfinex();
									return $bitfinex->rate($base,$to);
								}catch (\Exception $exception){
									throw new \Exception($exception->getMessage());
								}
							}
						}
					}
				}
			}
		}
	}

	public function exchangeTo($amount, $rate, $decimals=8)
	{
		return number_format($amount*$rate, $decimals, '.','');
	}

	public function exchangeFrom($amount, $rate, $decimals=8)
	{
		$unit_value = 1/$rate;
		return number_format($amount*$unit_value, $decimals, '.','');
	}
}