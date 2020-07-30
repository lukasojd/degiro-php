<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Connector;

use Lukasojd\DegiroPhp\Client;
use Lukasojd\DegiroPhp\Entity\ConfigsData;

class DegiroConnector
{

	private Client $client;

	private ?int $intAccount = null;

	private ?string $sessionId = null;

	public function __construct(?Client $client = null)
	{
		$this->client = $client ?? $this->getClient();
	}

	public function setIntAccount(?int $intAccount): void
	{
		$this->intAccount = $intAccount;
	}

	public function setSessionId(?string $sessionId): void
	{
		$this->sessionId = $sessionId;
	}

	/**
	 * @param mixed[] $params
	 */
	public function login(array $params): string
	{
		return $this->client->execute('https://trader.degiro.nl/login/secure/login', $params);
	}

	public function getConfigData(): string
	{
		return $this->client->execute('https://trader.degiro.nl/login/secure/config');
	}

	public function placeOrder(ConfigsData $configsData): string
	{
		$url = $configsData->getTradingUrl() . 'v5/checkOrder';
		$url = $this->fillInfoToUrl($url);

		return $this->client->execute($url);
	}

	/**
	 * @param mixed[] $postParams
	 */
	public function confirmOrder(ConfigsData $configsData, string $confirmationId, array $postParams): string
	{
		$url = $configsData->getTradingUrl() . 'v5/order/' . $confirmationId;
		$url = $this->fillInfoToUrl($url);

		return $this->client->execute($url, $postParams);
	}

	public function getStocksFromIndex(): string
	{
		$url = 'https://trader.degiro.nl/product_search/secure/v5/stocks?is' .
			'InUSGreenList=false&indexId=14&stockCountryId=846&searchText=' .
			'&offset=0&limit=500&requireTotal=true&sortColumns=name&sortTypes=asc';

		$url = $this->fillInfoToUrl($url, false);
		return $this->client->execute($url);
	}

	public function getUserData(ConfigsData $configsData): string
	{
		$paUrl = $configsData->getPaUrl() . 'client?sessionId=' . $this->sessionId;
		return $this->client->execute($paUrl);
	}

	public function getClient(): Client
	{
		return new Client();
	}

	private function fillInfoToUrl(string $url, bool $jsessionid = true): string
	{
		$sessionId = $this->sessionId;
		$intAccount = $this->intAccount;
		if ($sessionId !== null && $intAccount !== null) {
			if ($jsessionid) {
				$url .= sprintf(';jsessionid=%s', $sessionId);
			}

			$url .= parse_url($url, PHP_URL_QUERY) ?
				'&' :
				'?';

			$url .= sprintf('intAccount=%d&sessionId=%s', $intAccount, $sessionId);
		}

		return $url;
	}

}
