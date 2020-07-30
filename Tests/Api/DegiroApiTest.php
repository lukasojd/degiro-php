<?php declare(strict_types = 1);

namespace Tests\Api;

use Lukasojd\DegiroPhp\Api\DegiroApi;
use Lukasojd\DegiroPhp\Config;
use Lukasojd\DegiroPhp\Connector\DegiroConnector;
use Lukasojd\DegiroPhp\Entity\ConfigsData;
use Lukasojd\DegiroPhp\Entity\Stock;
use Lukasojd\DegiroPhp\Entity\UserData;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DegiroApiTest extends TestCase
{

	private Config $config;

	private DegiroApi $degiroApi;

	/**  @var DegiroConnector&MockObject */
	private $degiroConnector;

	public function setUp(): void
	{
		$this->degiroConnector = $this->createMock(DegiroConnector::class);

		$configData = file_get_contents(__DIR__ . '/../Fixtures/configData.json');
		$this->degiroConnector->method('getConfigData')->willReturn($configData);

		$loginData = file_get_contents(__DIR__ . '/../Fixtures/loginData.json');
		$this->degiroConnector->method('login')->willReturn($loginData);

		$userData = file_get_contents(__DIR__ . '/../Fixtures/userData.json');
		$this->degiroConnector->method('getUserData')->willReturn($userData);

		$this->config = new Config('test', 'test');
		$this->degiroApi = new DegiroApi($this->config, $this->degiroConnector);
	}

	public function testGetUserData(): void
	{
		$userData = $this->degiroApi->getUserData();
		$this->assertInstanceOf(UserData::class, $userData);
	}

	public function testGetDegiroConfig(): void
	{
		$userData = $this->degiroApi->getDegiroConfig();
		$this->assertInstanceOf(ConfigsData::class, $userData);
	}

	public function testGetStockByTickerFromIndex(): void
	{
		$stocks = file_get_contents(__DIR__ . '/../Fixtures/stocks.json');
		$this->degiroConnector->expects($this->once())->method('getStocksFromIndex')->willReturn($stocks);

		$this->assertInstanceOf(Stock::class, $this->degiroApi->getStockByTickerFromIndex('MMM'));
		$this->assertNull($this->degiroApi->getStockByTickerFromIndex('test'));
	}

	public function testPlaceOrder(): void
	{
		$this->degiroConnector
			->expects($this->once())
			->method('placeOrder')
			->willReturn(json_encode(['data' => ['confirmationId' => 'test']]));

		$this->degiroConnector
			->method('confirmOrder')
			->with($this->degiroApi->getDegiroConfig(), 'test', [
				'buySell' => 'BUY',
				'orderType' => 0,
				'productId' => '12345',
				'timeType' => 1,
				'size' => 1,
				'price' => 1.0,
			]);

		$stock = new Stock();
		$stock->setId('12345');
		$this->degiroApi->placeOrder($stock, 1, 1);
	}

	public function testPlaceOrderWithNull(): void
	{
		$this->degiroConnector
			->expects($this->once())
			->method('placeOrder')
			->willReturn(json_encode(['data' => ['confirmatidonId' => 'test']]));

		$this->degiroConnector
			->expects($this->never())
			->method('confirmOrder');

		$stock = new Stock();
		$stock->setId('12345');
		$this->degiroApi->placeOrder($stock, 1, 1);
	}

}
