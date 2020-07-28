<?php declare(strict_types = 1);

namespace Tests\Entity;

use Lukasojd\DegiroPhp\Entity\UserData;
use PHPUnit\Framework\TestCase;

class UserDataTest extends TestCase
{

	public function testCreate(): void
	{
		$userData = new UserData();
		$this->assertInstanceOf(UserData::class, $userData);
		$userData->setEmail('email');
		$userData->setDisplayName('display name');
		$userData->setUsername('username');
		$userData->setContractType('type');
		$userData->setEffectiveClientRole('role');
		$userData->setClientRole('clientRole');
		$userData->setIntAccount(21);
		$userData->setId(30);

		$this->assertSame('email', $userData->getEmail());
		$this->assertSame('display name', $userData->getDisplayName());
		$this->assertSame('username', $userData->getUsername());
		$this->assertSame('type', $userData->getContractType());
		$this->assertSame('role', $userData->getEffectiveClientRole());
		$this->assertSame('clientRole', $userData->getClientRole());
		$this->assertSame(21, $userData->getIntAccount());
		$this->assertSame(30, $userData->getId());
	}

}
