<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Entity;

class Stock
{

	private string $id;

	private string $name;

	private string $isin;

	private string $symbol;

	private string $productType;

	private string $currency;

	public function getId(): string
	{
		return $this->id;
	}

	public function setId(string $id): void
	{
		$this->id = $id;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): void
	{
		$this->name = $name;
	}

	public function getIsin(): string
	{
		return $this->isin;
	}

	public function setIsin(string $isin): void
	{
		$this->isin = $isin;
	}

	public function getSymbol(): string
	{
		return $this->symbol;
	}

	public function setSymbol(string $symbol): void
	{
		$this->symbol = $symbol;
	}

	public function getProductType(): string
	{
		return $this->productType;
	}

	public function setProductType(string $productType): void
	{
		$this->productType = $productType;
	}

	public function getCurrency(): string
	{
		return $this->currency;
	}

	public function setCurrency(string $currency): void
	{
		$this->currency = $currency;
	}

}
