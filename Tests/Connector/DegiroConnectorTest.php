<?php declare(strict_types = 1);

namespace Tests\Connector;

use Lukasojd\DegiroPhp\Client;
use Lukasojd\DegiroPhp\Connector\DegiroConnector;
use Lukasojd\DegiroPhp\Entity\ConfigsData;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DegiroConnectorTest extends TestCase
{

	/**  @var Client&MockObject */
	private $client;

	private DegiroConnector $degiroConnector;

	public function setUp(): void
	{
		$this->client = $this->createMock(Client::class);
		$this->degiroConnector = new DegiroConnector($this->client);
		$this->degiroConnector->setSessionId('sessionId');
		$this->degiroConnector->setIntAccount(123);
	}

	public function testLogin(): void
	{
		$data = ['test' => 'test'];

		$this->client->expects($this->once())->method('execute')
			->with('https://trader.degiro.nl/login/secure/login', $data)
			->willReturn('login');

		$this->assertSame('login', $this->degiroConnector->login($data));
	}

	public function testGetConfigData(): void
	{
		$this->client->expects($this->once())->method('execute')
			->with('https://trader.degiro.nl/login/secure/config')
			->willReturn('config');

		$this->assertSame('config', $this->degiroConnector->getConfigData());
	}

	public function testGetStocksFromIndex(): void
	{
		$this->client->expects($this->once())->method('execute')
			->with('https://trader.degiro.nl/product_search/secure/v5/stocks?isInUSGreenList=false' .
				'&indexId=14&stockCountryId=846&searchText=&offset=0&limit=500' .
				'&requireTotal=true&sortColumns=name&sortTypes=asc&intAccount=123&sessionId=sessionId')
			->willReturn('index');

		$this->assertSame('index', $this->degiroConnector->getStocksFromIndex());
	}

	public function testGetUserData(): void
	{
		$this->client->expects($this->once())->method('execute')
			->with('paUrlclient?sessionId=sessionId')
			->willReturn('userData');

		$configsData = new ConfigsData();
		$configsData->setPaUrl('paUrl');
		$this->assertSame('userData', $this->degiroConnector->getUserData($configsData));
	}

	public function testGetClient(): void
	{
		$this->assertInstanceOf(Client::class, $this->degiroConnector->getClient());
	}

	public function testPlaceOrder(): void
	{
		$this->client->expects($this->once())->method('execute')
			->with('trading/v5/checkOrder;jsessionid=sessionId?intAccount=123&sessionId=sessionId')
			->willReturn('placeOrder');

		$configsData = new ConfigsData();
		$configsData->setTradingUrl('trading/');
		$this->assertSame('placeOrder', $this->degiroConnector->placeOrder($configsData));
	}

	public function testConfirmOrder(): void
	{
		$this->client->expects($this->once())->method('execute')
			->with('trading/v5/order/test;jsessionid=sessionId?intAccount=123&sessionId=sessionId', ['test'])
			->willReturn('confirmOrder');

		$configsData = new ConfigsData();
		$configsData->setTradingUrl('trading/');

		$this->assertSame(
			'confirmOrder',
			$this->degiroConnector->confirmOrder($configsData, 'test', ['test'])
		);
	}

	public function testGetOpenOrders(): void
	{
		$this->client->expects($this->once())->method('execute')
			->with('trading/v5/update/123;jsessionid=sessionId?orders=0')
			->willReturn('getOpenOrders');

		$configsData = new ConfigsData();
		$configsData->setTradingUrl('trading/');

		$this->assertSame(
			'getOpenOrders',
			$this->degiroConnector->getOpenOrders($configsData)
		);
	}

}
