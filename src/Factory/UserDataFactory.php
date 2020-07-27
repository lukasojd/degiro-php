<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Factory;

use Lukasojd\DegiroPhp\Entity\UserData;

class UserDataFactory
{

	public function create(string $data): UserData
	{
		$userData = new UserData();
		$array = json_decode($data, true);
		if (isset($array['data']) && is_array($array['data'])) {
			$dataArray = $array['data'];
			$userData->setId($dataArray['id']);
			$userData->setIntAccount($dataArray['intAccount']);
			$userData->setClientRole($dataArray['clientRole']);
			$userData->setEffectiveClientRole($dataArray['effectiveClientRole']);
			$userData->setContractType($dataArray['contractType']);
			$userData->setUsername($dataArray['username']);
			$userData->setDisplayName($dataArray['displayName']);
			$userData->setEmail($dataArray['email']);
		}
		return $userData;
	}

}
