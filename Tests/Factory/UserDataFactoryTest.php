<?php declare(strict_types = 1);

namespace Tests\Factory;

use Lukasojd\DegiroPhp\Entity\UserData;
use Lukasojd\DegiroPhp\Factory\UserDataFactory;
use PHPUnit\Framework\TestCase;

class UserDataFactoryTest extends TestCase
{

	private UserDataFactory $userDataFactory;

	public function setUp(): void
	{
		$this->userDataFactory = new UserDataFactory();
	}

	public function testCreate(): void
	{
		$data = file_get_contents(__DIR__ . '/../Fixtures/userData.json');
		$exceptedUserData = new UserData();
		$exceptedUserData->setId(123);
		$exceptedUserData->setIntAccount(456);
		$exceptedUserData->setClientRole('basic');
		$exceptedUserData->setEffectiveClientRole('basic');
		$exceptedUserData->setContractType('PRIVATE');
		$exceptedUserData->setUsername('username');
		$exceptedUserData->setDisplayName('John Doe');
		$exceptedUserData->setEmail('test@test.cz');
		$actualUserData = $this->userDataFactory->create($data);
		$this->assertEquals($exceptedUserData, $actualUserData);
	}

}
