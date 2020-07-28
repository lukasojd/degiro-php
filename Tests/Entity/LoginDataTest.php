<?php declare(strict_types = 1);

namespace Tests\Entity;

use Lukasojd\DegiroPhp\Entity\LoginData;
use PHPUnit\Framework\TestCase;

class LoginDataTest extends TestCase
{

	public function testCreate(): void
	{
		$loginData = new LoginData();
		$loginData->setLocale('cz');
		$loginData->setSessionId('sessionId');

		$this->assertSame('cz', $loginData->getLocale());
		$this->assertSame('sessionId', $loginData->getSessionId());
	}

}
