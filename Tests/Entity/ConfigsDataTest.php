<?php declare(strict_types = 1);

namespace Tests\Entity;

use Lukasojd\DegiroPhp\Entity\ConfigsData;
use PHPUnit\Framework\TestCase;

class ConfigsDataTest extends TestCase
{

	public function testCreate(): void
	{
		$configsData = new ConfigsData();
		$configsData->setTradingUrl('tradingUrl');
		$configsData->setReportingUrl('reportingUrl');
		$configsData->setProductTypesUrl('productTypesUrl');
		$configsData->setProductSearchUrl('productSearchUrl');
		$configsData->setCashSolutionsUrl('cashSolutionsUrl');
		$configsData->setPaymentServiceUrl('paymentServiceUrl');
		$configsData->setPaUrl('paUrl');
		$configsData->setLoginUrl('loginUrl');
		$configsData->setDictionaryUrl('dictionaryUrl');
		$configsData->setCompaniesServiceUrl('companiesServiceUrl');
		$configsData->setClientId(12345);
		$configsData->setSessionId('sessionId');

		$this->assertSame('tradingUrl', $configsData->getTradingUrl());
		$this->assertSame('reportingUrl', $configsData->getReportingUrl());
		$this->assertSame('productTypesUrl', $configsData->getProductTypesUrl());
		$this->assertSame('productSearchUrl', $configsData->getProductSearchUrl());
		$this->assertSame('cashSolutionsUrl', $configsData->getCashSolutionsUrl());
		$this->assertSame('paymentServiceUrl', $configsData->getPaymentServiceUrl());
		$this->assertSame('paUrl', $configsData->getPaUrl());
		$this->assertSame('loginUrl', $configsData->getLoginUrl());
		$this->assertSame('dictionaryUrl', $configsData->getDictionaryUrl());
		$this->assertSame('companiesServiceUrl', $configsData->getCompaniesServiceUrl());
		$this->assertSame(12345, $configsData->getClientId());
		$this->assertSame('sessionId', $configsData->getSessionId());
	}

}
