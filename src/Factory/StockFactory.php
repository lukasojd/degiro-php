<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Factory;

use Lukasojd\DegiroPhp\Entity\Stock;

class StockFactory
{

	/**
	 * @param mixed[] $product
	 */
	public function create(array $product): Stock
	{
		$stock = new Stock();

		$stock->setId($product['id']);
		$stock->setProductType($product['productType']);
		$stock->setSymbol($product['symbol']);
		$stock->setName($product['name']);
		$stock->setCurrency($product['currency']);
		$stock->setIsin($product['isin']);

		return $stock;
	}

}
