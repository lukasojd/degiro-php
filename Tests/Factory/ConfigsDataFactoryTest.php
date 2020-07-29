<?php declare(strict_types = 1);

namespace Tests\Factory;

use Lukasojd\DegiroPhp\Entity\ConfigsData;
use Lukasojd\DegiroPhp\Factory\ConfigDataFactory;
use PHPUnit\Framework\TestCase;

class ConfigsDataFactoryTest extends TestCase
{

	private ConfigDataFactory $configsDataFactory;

	public function setUp(): void
	{
		$this->configsDataFactory = new ConfigDataFactory();
	}

	public function testCreate(): void
	{
		$data = [
			'data' => [
				'tradingUrl' => 'https://trader.degiro.nl/trading/secure/',
				'paUrl' => 'https://trader.degiro.nl/pa/secure/',
				'reportingUrl' => 'https://trader.degiro.nl/reporting/secure/',
				'paymentServiceUrl' => 'https://trader.degiro.nl/payments/',
				'cashSolutionsUrl' => '',
				'productSearchUrl' => 'https://trader.degiro.nl/product_search/secure/',
				'dictionaryUrl' => 'https://trader.degiro.nl/product_search/config/dictionary/',
				'productTypesUrl' => 'https://trader.degiro.nl/product_search/config/productTypes/',
				'companiesServiceUrl' => 'https://trader.degiro.nl/dgtbxdsservice/',
				'loginUrl' => 'https://trader.degiro.nl/login/cz',
				'sessionId' => 'abc.prod_b_113_3',
				'clientId' => 12345]];
		$configsData = $this->configsDataFactory->create($data);

		$configsDataExcepted = new ConfigsData();
		$configsDataExcepted->setTradingUrl('https://trader.degiro.nl/trading/secure/');
		$configsDataExcepted->setClientId(12345);
		$configsDataExcepted->setSessionId('abc.prod_b_113_3');
		$configsDataExcepted->setLoginUrl('https://trader.degiro.nl/login/cz');
		$configsDataExcepted->setPaUrl('https://trader.degiro.nl/pa/secure/');
		$configsDataExcepted->setReportingUrl('https://trader.degiro.nl/reporting/secure/');
		$configsDataExcepted->setCashSolutionsUrl('');
		$configsDataExcepted->setPaymentServiceUrl('https://trader.degiro.nl/payments/');
		$configsDataExcepted->setProductSearchUrl('https://trader.degiro.nl/product_search/secure/');
		$configsDataExcepted->setDictionaryUrl('https://trader.degiro.nl/product_search/config/dictionary/');
		$configsDataExcepted->setProductTypesUrl('https://trader.degiro.nl/product_search/config/productTypes/');
		$configsDataExcepted->setCompaniesServiceUrl('https://trader.degiro.nl/dgtbxdsservice/');

		$this->assertEquals($configsDataExcepted, $configsData);
	}

}
