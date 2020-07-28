<?php declare(strict_types = 1);

namespace Tests\Factory;

use Lukasojd\DegiroPhp\Entity\Stock;
use Lukasojd\DegiroPhp\Factory\StockFactory;
use PHPUnit\Framework\TestCase;

class StockFactoryTest extends TestCase
{

	private StockFactory $stockFactory;

	public function setUp(): void
	{
		$this->stockFactory = new StockFactory();
	}

	public function testCreate(): void
	{
		$input = [
			'id' => '332010',
			'name' => '3M',
			'isin' => 'US88579Y1010',
			'symbol' => 'MMM',
			'contractSize' => 1.0,
			'productType' => 'STOCK',
			'productTypeId' => 1,
			'tradable' => true,
			'category' => 'A',
			'currency' => 'USD',
			'exchangeId' => '676',
		];
		$stock = $this->stockFactory->create($input);

		$exceptedStock = new Stock();
		$exceptedStock->setId('332010');
		$exceptedStock->setProductType('STOCK');
		$exceptedStock->setSymbol('MMM');
		$exceptedStock->setName('3M');
		$exceptedStock->setCurrency('USD');
		$exceptedStock->setIsin('US88579Y1010');

		$this->assertEquals($exceptedStock, $stock);
	}

}
