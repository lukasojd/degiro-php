<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Entity;

class ConfigsData
{

	private ?string $tradingUrl;

	private ?string $paUrl;

	private ?string $reportingUrl;

	private ?string $paymentServiceUrl;

	private ?string $cashSolutionsUrl;

	private ?string $productSearchUrl;

	private ?string $dictionaryUrl;

	private ?string $productTypesUrl;

	private ?string $companiesServiceUrl;

	private ?string $loginUrl;

	public function getTradingUrl(): ?string
	{
		return $this->tradingUrl;
	}

	public function setTradingUrl(?string $tradingUrl): void
	{
		$this->tradingUrl = $tradingUrl;
	}

	public function getPaUrl(): ?string
	{
		return $this->paUrl;
	}

	public function setPaUrl(?string $paUrl): void
	{
		$this->paUrl = $paUrl;
	}

	public function getReportingUrl(): ?string
	{
		return $this->reportingUrl;
	}

	public function setReportingUrl(?string $reportingUrl): void
	{
		$this->reportingUrl = $reportingUrl;
	}

	public function getPaymentServiceUrl(): ?string
	{
		return $this->paymentServiceUrl;
	}

	public function setPaymentServiceUrl(?string $paymentServiceUrl): void
	{
		$this->paymentServiceUrl = $paymentServiceUrl;
	}

	public function getCashSolutionsUrl(): ?string
	{
		return $this->cashSolutionsUrl;
	}

	public function setCashSolutionsUrl(?string $cashSolutionsUrl): void
	{
		$this->cashSolutionsUrl = $cashSolutionsUrl;
	}

	public function getProductSearchUrl(): ?string
	{
		return $this->productSearchUrl;
	}

	public function setProductSearchUrl(?string $productSearchUrl): void
	{
		$this->productSearchUrl = $productSearchUrl;
	}

	public function getDictionaryUrl(): ?string
	{
		return $this->dictionaryUrl;
	}

	public function setDictionaryUrl(?string $dictionaryUrl): void
	{
		$this->dictionaryUrl = $dictionaryUrl;
	}

	public function getProductTypesUrl(): ?string
	{
		return $this->productTypesUrl;
	}

	public function setProductTypesUrl(?string $productTypesUrl): void
	{
		$this->productTypesUrl = $productTypesUrl;
	}

	public function getCompaniesServiceUrl(): ?string
	{
		return $this->companiesServiceUrl;
	}

	public function setCompaniesServiceUrl(?string $companiesServiceUrl): void
	{
		$this->companiesServiceUrl = $companiesServiceUrl;
	}

	public function getLoginUrl(): ?string
	{
		return $this->loginUrl;
	}

	public function setLoginUrl(?string $loginUrl): void
	{
		$this->loginUrl = $loginUrl;
	}

}
