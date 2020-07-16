<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Factory;

use Lukasojd\DegiroPhp\Entity\ConfigsData;

class ConfigDataFactory
{

	/** @param mixed[] $data */
	public function create(array $data): ConfigsData
	{
		$configsData = new ConfigsData();
		$configsData->setCashSolutionsUrl($data['data']['cashSolutionsUrl'] ?? null);
		$configsData->setCompaniesServiceUrl($data['data']['companiesServiceUrl'] ?? null);
		$configsData->setDictionaryUrl($data['data']['dictionaryUrl'] ?? null);
		$configsData->setLoginUrl($data['data']['loginUrl'] ?? null);
		$configsData->setPaUrl($data['data']['paUrl'] ?? null);
		$configsData->setPaymentServiceUrl($data['data']['paymentServiceUrl'] ?? null);
		$configsData->setCashSolutionsUrl($data['data']['cashSolutionsUrl'] ?? null);
		$configsData->setProductSearchUrl($data['data']['productSearchUrl'] ?? null);
		$configsData->setProductTypesUrl($data['data']['productTypesUrl'] ?? null);
		$configsData->setReportingUrl($data['data']['reportingUrl'] ?? null);
		$configsData->setTradingUrl($data['data']['tradingUrl'] ?? null);

		return $configsData;
	}

}
