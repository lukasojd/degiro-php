<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Factory;

use Lukasojd\DegiroPhp\Entity\LoginData;

class LoginDataFactory
{

	public function create(string $data): LoginData
	{
		$array = json_decode($data, true);
		$loginData = new LoginData();
		$loginData->setSessionId($array['sessionId'] ?? '');
		$loginData->setLocale($array['locale'] ?? '');

		return $loginData;
	}

}
