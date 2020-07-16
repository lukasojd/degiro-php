<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp;

use Lukasojd\DegiroPhp\Builder\ConfigsDataBuilder;
use Lukasojd\DegiroPhp\Entity\ConfigsData;

class DegiroApi
{

	protected Client $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function login(Config $config): string
	{
		$params = [
			'username' => $config->getLogin(),
			'password' => $config->getPassword(),
			'isPassCodeReset' => false,
			'isRedirectToMobile' => false,
			'queryParams' => [],
		];

		return $this->client->execute('/login/secure/login', $params);
	}

	public function getDegiroConfig(): ConfigsData
	{
		$configs = $this->client->execute('/login/secure/config');
		$configsDataBuilder = new ConfigsDataBuilder();
		return $configsDataBuilder->build($configs);
	}

}
