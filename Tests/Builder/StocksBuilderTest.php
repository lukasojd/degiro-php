<?php declare(strict_types = 1);

namespace Tests\Builder;

use Lukasojd\DegiroPhp\Builder\StocksBuilder;
use Lukasojd\DegiroPhp\Entity\Stock;
use PHPUnit\Framework\TestCase;

class StocksBuilderTest extends TestCase
{

	private StocksBuilder $stocksBuilder;

	public function setUp(): void
	{
		$this->stocksBuilder = new StocksBuilder();
	}

	public function testCreate(): void
	{
		$stocks = file_get_contents(__DIR__ . '/fixtures/stocks.json');
		$products = $this->stocksBuilder->build($stocks);
		$this->assertIsArray($products);
		$this->assertInstanceOf(Stock::class, reset($products));
	}

}
