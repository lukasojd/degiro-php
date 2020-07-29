<?php declare(strict_types = 1);

namespace Tests\Builder;

use Lukasojd\DegiroPhp\Builder\ConfigsDataBuilder;
use Lukasojd\DegiroPhp\Entity\ConfigsData;
use PHPUnit\Framework\TestCase;

class ConfigsDataBuilderTest extends TestCase
{

	public function testCreateConfigs(): void
	{
		$request = file_get_contents(__DIR__ . '/../Fixtures/configData.json');
		$configsDataBuilder = new ConfigsDataBuilder();
		$configsData = $configsDataBuilder->build($request);
		$this->assertInstanceOf(ConfigsData::class, $configsDataBuilder->build($request));
		$this->assertSame('https://trader.degiro.nl/login/cz', $configsData->getLoginUrl());
	}

}
