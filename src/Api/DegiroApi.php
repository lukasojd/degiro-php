<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Api;

use Lukasojd\DegiroPhp\Builder\ConfigsDataBuilder;
use Lukasojd\DegiroPhp\Builder\StocksBuilder;
use Lukasojd\DegiroPhp\Client;
use Lukasojd\DegiroPhp\Config;
use Lukasojd\DegiroPhp\Entity\ConfigsData;
use Lukasojd\DegiroPhp\Entity\DegiroConnector;
use Lukasojd\DegiroPhp\Entity\LoginData;
use Lukasojd\DegiroPhp\Entity\Stock;
use Lukasojd\DegiroPhp\Entity\UserData;
use Lukasojd\DegiroPhp\Factory\LoginDataFactory;
use Lukasojd\DegiroPhp\Factory\UserDataFactory;
use Lukasojd\DegiroPhp\Repository\StocksRepository;

class DegiroApi
{

	protected Client $client;

	protected ConfigsData $configsData;

	protected LoginData $loginData;

	protected UserData $userData;

	/** @var Stock[]|null */
	protected $stocks = null;

	private DegiroConnector $degiroConnector;

	public function __construct(Config $config, ?DegiroConnector $degiroConnector = null)
	{
		$this->degiroConnector = $degiroConnector ?? new DegiroConnector();
		$this->loginData = $this->login($config);
		$this->configsData = $this->getDegiroConfig();
		$this->userData = $this->getUserData();
		$this->degiroConnector->setSessionInfo($this->loginData->getSessionId(), $this->userData->getIntAccount());
	}

	protected function login(Config $config): LoginData
	{
		$params = [
			'username' => $config->getLogin(),
			'password' => $config->getPassword(),
			'isPassCodeReset' => false,
			'isRedirectToMobile' => false,
			'queryParams' => [],
		];

		$login = $this->degiroConnector->login($params);
		$loginFactory = new LoginDataFactory();

		return $loginFactory->create($login);
	}

	public function getDegiroConfig(): ConfigsData
	{
		$configs = $this->degiroConnector->getConfigData();
		$configsDataBuilder = new ConfigsDataBuilder();
		return $configsDataBuilder->build($configs);
	}

	public function getUserData(): UserData
	{
		$result = $this->degiroConnector->getUserData($this->getDegiroConfig());
		$userDataFactory = new UserDataFactory();
		return $userDataFactory->create($result);
	}

	public function placeOrder(Stock $stock, int $qty, float $price): void
	{
		$price = (float) $price;

		$posts = [
			'buySell' => 'BUY',
			'orderType' => 0,
			'productId' => $stock->getId(),
			'timeType' => 1,
			'size' => $qty,
			'price' => $price,
		];

		$result = $this->degiroConnector->placeOrder($this->configsData);
		$result = json_decode($result, true);

		if (!isset($result['data']['confirmationId'])) {
			return;
		}

		$confirmationId = $result['data']['confirmationId'];
		$this->confirmOrder($confirmationId, $posts);
	}

	/**
	 * @param mixed[] $postParams
	 */
	private function confirmOrder(string $confirmationId, array $postParams): void
	{
		$this->degiroConnector->confirmOrder($this->configsData, $confirmationId, $postParams);
	}

	/**
	 * @return mixed[]
	 */
	private function getStockFromIndex(): array
	{
		$response = $this->degiroConnector->getStocksFromIndex();
		$stockFactoryBuilder = new StocksBuilder();

		return $stockFactoryBuilder->build($response);
	}

	public function getStockByTickerFromIndex(string $ticker): ?Stock
	{
		if ($this->stocks === null) {
			$this->stocks = $this->getStockFromIndex();
		}

		$stocksRepository = new StocksRepository();

		return $stocksRepository->findStock($this->stocks, $ticker);
	}

}
