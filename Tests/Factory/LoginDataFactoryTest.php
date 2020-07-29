<?php declare(strict_types = 1);

namespace Tests\Factory;

use Lukasojd\DegiroPhp\Entity\LoginData;
use Lukasojd\DegiroPhp\Factory\LoginDataFactory;
use PHPUnit\Framework\TestCase;

class LoginDataFactoryTest extends TestCase
{

	private LoginDataFactory $loginDataFactory;

	public function setUp(): void
	{
		$this->loginDataFactory = new LoginDataFactory();
	}

	public function testCreate(): void
	{
		$loginDataExcepted = new LoginData();
		$loginDataExcepted->setLocale('cs_CZ');
		$loginDataExcepted->setSessionId('test.test');
		$data = file_get_contents(__DIR__ . '/../Fixtures/loginData.json');
		$loginDataActual = $this->loginDataFactory->create($data);
		$this->assertEquals($loginDataExcepted, $loginDataActual);
	}

}
