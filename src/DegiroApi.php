<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp;

use Lukasojd\DegiroPhp\Builder\ConfigsDataBuilder;
use Lukasojd\DegiroPhp\Entity\ConfigsData;
use Lukasojd\DegiroPhp\Entity\LoginData;
use Lukasojd\DegiroPhp\Entity\UserData;
use Lukasojd\DegiroPhp\Factory\LoginDataFactory;
use Lukasojd\DegiroPhp\Factory\UserDataFactory;

class DegiroApi
{

	protected Client $client;

	protected ConfigsData $configsData;

	protected LoginData $loginData;

	protected UserData $userData;

	public function __construct(Client $client, Config $config)
	{
		$this->client = $client;

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
		$url = $this->configsData->getTradingUrl() . 'v5/update/' . $this->userData->getIntAccount()
			. ';jsessionid=' . $this->loginData->getSessionId() . '?orders=0';

		$this->client->execute($url);
		//todo logic
	}

}
