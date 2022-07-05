<?php
/**
 * @package EvolutionScript
 * @author: EvolutionScript S.A.C.
 * @Copyright (c) 2010 - 2020, EvolutionScript.com
 * @link http://www.evolutionscript.com
 */

namespace EvolutionScript\CryptocurrencyAPI\Providers;


interface Provider
{
	public function rate($base, $to);
}