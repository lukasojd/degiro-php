<?php declare(strict_types = 1);

namespace Tests\Repository;

use Lukasojd\DegiroPhp\Entity\Stock;
use Lukasojd\DegiroPhp\Repository\StocksRepository;
use PHPUnit\Framework\TestCase;

class StocksRepositoryTest extends TestCase
{

	private StocksRepository $stocksRepository;

	public function setUp(): void
	{
		$this->stocksRepository = new StocksRepository();
	}

	public function testFindStock(): void
	{
		$stock = new Stock();
		$stock->setSymbol('AAPL');

		$stock2 = new Stock();
		$stock2->setSymbol('GOOGL');

		$this->assertSame($stock, $this->stocksRepository->findStock([$stock, $stock2], 'AAPL'));
		$this->assertSame($stock2, $this->stocksRepository->findStock([$stock, $stock2], 'GOOGL'));
		$this->assertNull($this->stocksRepository->findStock(['invalid'], 'AAPL'));
		$this->assertNull($this->stocksRepository->findStock([$stock, $stock2], 'GOOGLd'));
	}

}
