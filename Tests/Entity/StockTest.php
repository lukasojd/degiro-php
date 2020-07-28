<?php declare(strict_types = 1);

namespace Tests\Entity;

use Lukasojd\DegiroPhp\Entity\Stock;
use PHPUnit\Framework\TestCase;

class StockTest extends TestCase
{

	public function testCreate(): void
	{
		$stock = new Stock();
		$stock->setId('id');
		$stock->setCurrency('currency');
		$stock->setName('name');
		$stock->setIsin('isin');
		$stock->setProductType('type');
		$stock->setSymbol('symbol');
		$stock->setClosePrice(123.0);
		$stock->setClosePriceDate('priceDatum');

		$this->assertSame('id', $stock->getId());
		$this->assertSame('currency', $stock->getCurrency());
		$this->assertSame('name', $stock->getName());
		$this->assertSame('isin', $stock->getIsin());
		$this->assertSame('type', $stock->getProductType());
		$this->assertSame('symbol', $stock->getSymbol());
		$this->assertSame(123.0, $stock->getClosePrice());
		$this->assertSame('priceDatum', $stock->getClosePriceDate());
	}

}
