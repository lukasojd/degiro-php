<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp;

use Lukasojd\DegiroPhp\Builder\ConfigsDataBuilder;
use Lukasojd\DegiroPhp\Builder\StocksBuilder;
use Lukasojd\DegiroPhp\Entity\ConfigsData;
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

	public function __construct(Config $config)
	{
		$this->client = $this->getClient();

		$this->loginData = $this->login($config);
		$this->configsData = $this->getDegiroConfig();
		$this->userData = $this->getUserData();
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

		$login = $this->client->execute('https://trader.degiro.nl/login/secure/login', $params);
		$loginFactory = new LoginDataFactory();

		return $loginFactory->create($login);
	}

	public function getDegiroConfig(): ConfigsData
	{
		$configs = $this->client->execute('https://trader.degiro.nl/login/secure/config');
		$configsDataBuilder = new ConfigsDataBuilder();
		return $configsDataBuilder->build($configs);
	}

	public function getUserData(): UserData
	{
		$paUrl = $this->getDegiroConfig()->getPaUrl() . 'client?sessionId=' . $this->loginData->getSessionId();
		$result = $this->client->execute($paUrl);
		$userDataFactory = new UserDataFactory();
		return $userDataFactory->create($result);
	}

	public function getOpenOrders(): void
	{
		$url = $this->configsData->getTradingUrl() . 'v5/update/?orders=0';
		$url = $this->fillInfoToUrl($url);

		$this->client->execute($url);
		//todo logic
	}

	public function placeOrder(Stock $stock, int $qty, float $price): void
	{
		$price = (float) $price;

		$url = $this->configsData->getTradingUrl() . 'v5/checkOrder';
		$url = $this->fillInfoToUrl($url);
		$posts = [
			'buySell' => 'BUY',
			'orderType' => 0,
			'productId' => $stock->getId(),
			'timeType' => 1,
			'size' => $qty,
			'price' => $price,
		];

		$result = $this->client->execute($url, $posts);
		$result = json_decode($result, true);

		if (isset($result['data']['confirmationId'])) {
			$confirmationId = $result['data']['confirmationId'];
			$this->confirmOrder($confirmationId, $posts);
		} else {
			echo "Error placing order, check result\n";
		}
	}

	/**
	 * @param mixed[] $postParams
	 */
	private function confirmOrder(string $confirmationId, array $postParams): void
	{
		$url = $this->configsData->getTradingUrl() . 'v5/order/' . $confirmationId;
		$url = $this->fillInfoToUrl($url);

		$result = $this->client->execute($url, $postParams);

		$result = json_decode($result, true);

		if (isset($result['errors'])) {
			echo "Error confirming order, check result\n";
		}
	}

	private function fillInfoToUrl(string $url, bool $jsessionid = true): string
	{
		$sessionId = $this->loginData->getSessionId();
		$intAccount = $this->userData->getIntAccount();
		if ($jsessionid) {
			$url .= ';jsessionid=' . $sessionId;
		}
		$url .= parse_url($url, PHP_URL_QUERY) ?
			'&' :
			'?';
		$url .= 'intAccount=' . $intAccount . '&sessionId=' . $sessionId;

		return $url;
	}

	/**
	 * @return mixed[]
	 * @throws Exception\StatusCodeException
	 */
	private function getStockFromIndex(): array
	{
		$url = 'https://trader.degiro.nl/product_search/secure/v5/stocks?isInUSGreenList=false&indexId=14&stockCountryId=846&searchText=&offset=0&limit=500&requireTotal=true&sortColumns=name&sortTypes=asc';
		$url = $this->fillInfoToUrl($url, false);
		$response = $this->client->execute($url);
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

	public function getClient(): Client
	{
		return new Client();
	}

}
