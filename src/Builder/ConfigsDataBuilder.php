<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Builder;

use Lukasojd\DegiroPhp\Entity\ConfigsData;
use Lukasojd\DegiroPhp\Factory\ConfigDataFactory;

class ConfigsDataBuilder
{

	public function build(string $json): ConfigsData
	{
		$json = json_decode($json, true);
		$configDataFactory = new ConfigDataFactory();
		return $configDataFactory->create($json);
	}

}
