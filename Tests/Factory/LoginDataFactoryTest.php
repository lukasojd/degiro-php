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
		$loginDataExcepted->setSessionId('3063AD7BA8390B7E229A02C0D9FD5603.prod_b_113_3');
		$data = '{"isPassCodeEnabled":true,"locale":"cs_CZ","redirectUrl":"https://trader.degiro.nl/trader/","sessionId":"3063AD7BA8390B7E229A02C0D9FD5603.prod_b_113_3","status":0,"statusText":"success"}';
		$loginDataActual = $this->loginDataFactory->create($data);
		$this->assertEquals($loginDataExcepted, $loginDataActual);
	}

}
