<?php declare(strict_types = 1);

namespace Tests;

use Lukasojd\DegiroPhp\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

	public function testCreate(): void
	{
		$config = new Config('login', 'password');
		$this->assertSame('login', $config->getLogin());
		$this->assertSame('password', $config->getPassword());
	}

}
