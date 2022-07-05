# Free Cryptocurrency Rate API

The Free Cryptocurrency Rate API connects with the popular exchangers to get the selected pair rate.

Supported exchangers:
* Binance
* Gemini
* Kraken
* Kucoin
* Bybit
* Bittrex
* Bitfinex


**Installation:**

```bash
composer require evolutionscript/crypto_api
```


**Usage:**

```php
$exchange = new \EvolutionScript\CryptocurrencyAPI\Exchange();
//Get rate from pair BTCUSDT, it will get the rate from Binance first, but if api fails or pair does not exist, the system will continue with the next exchanger and so on until get a valid response.
$rate = $exchange->rate('BTC','USDT');
echo 'The value of pair BTCUSDT is '.$rate.'<br>';

//We can get the rate from a specific exchanger
$kucoin = new \EvolutionScript\CryptocurrencyAPI\Providers\Kucoin();
$kucoin_rate = $kucoin->rate('BTC','USDT');
echo 'The value of pair BTCUSDT from Kucoin is '.$kucoin_rate.'<br>';

//Get the amount of 10 bitcoins with 2 decimals
$result = $exchange->exchangeTo(10, $rate, 2);
echo '10 BTC is equivalent to '.$result.' USDT<br>';

//Get the amount of 150 USDT in bitcoin with 4 decimals
$result = $exchange->exchangeFrom(150, $rate, 4);
echo '150 USDT is equivalent to '.$result.' BTC';
```
