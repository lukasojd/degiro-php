<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Entity;

class Order
{

	private string $id;

	private string $date;

	private string $product;

	private int $productId;

	private int $contractType;

	private float $contractSize;

	private string $currency;

	private string $buysell;

	private float $size;

	private float $quantity;

	private float $price;

	private float $stopPrice;

	private float $totalOrderValue;

	private int $orderTypeId;

	private int $orderTimeTypeId;

	private string $orderType;

	private string $orderTimeType;

	private bool $isModifiable;

	private bool $isDeletable;

	public function getId(): string
	{
		return $this->id;
	}

	public function setId(string $id): void
	{
		$this->id = $id;
	}

	public function getDate(): string
	{
		return $this->date;
	}

	public function setDate(string $date): void
	{
		$this->date = $date;
	}

	public function getProduct(): string
	{
		return $this->product;
	}

	public function setProduct(string $product): void
	{
		$this->product = $product;
	}

	public function getProductId(): int
	{
		return $this->productId;
	}

	public function setProductId(int $productId): void
	{
		$this->productId = $productId;
	}

	public function getContractType(): int
	{
		return $this->contractType;
	}

	public function setContractType(int $contractType): void
	{
		$this->contractType = $contractType;
	}

	public function getContractSize(): float
	{
		return $this->contractSize;
	}

	public function setContractSize(float $contractSize): void
	{
		$this->contractSize = $contractSize;
	}

	public function getCurrency(): string
	{
		return $this->currency;
	}

	public function setCurrency(string $currency): void
	{
		$this->currency = $currency;
	}

	public function getBuysell(): string
	{
		return $this->buysell;
	}

	public function setBuysell(string $buysell): void
	{
		$this->buysell = $buysell;
	}

	public function getSize(): float
	{
		return $this->size;
	}

	public function setSize(float $size): void
	{
		$this->size = $size;
	}

	public function getQuantity(): float
	{
		return $this->quantity;
	}

	public function setQuantity(float $quantity): void
	{
		$this->quantity = $quantity;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function setPrice(float $price): void
	{
		$this->price = $price;
	}

	public function getStopPrice(): float
	{
		return $this->stopPrice;
	}

	public function setStopPrice(float $stopPrice): void
	{
		$this->stopPrice = $stopPrice;
	}

	public function getTotalOrderValue(): float
	{
		return $this->totalOrderValue;
	}

	public function setTotalOrderValue(float $totalOrderValue): void
	{
		$this->totalOrderValue = $totalOrderValue;
	}

	public function getOrderTypeId(): int
	{
		return $this->orderTypeId;
	}

	public function setOrderTypeId(int $orderTypeId): void
	{
		$this->orderTypeId = $orderTypeId;
	}

	public function getOrderTimeTypeId(): int
	{
		return $this->orderTimeTypeId;
	}

	public function setOrderTimeTypeId(int $orderTimeTypeId): void
	{
		$this->orderTimeTypeId = $orderTimeTypeId;
	}

	public function getOrderType(): string
	{
		return $this->orderType;
	}

	public function setOrderType(string $orderType): void
	{
		$this->orderType = $orderType;
	}

	public function getOrderTimeType(): string
	{
		return $this->orderTimeType;
	}

	public function setOrderTimeType(string $orderTimeType): void
	{
		$this->orderTimeType = $orderTimeType;
	}

	public function isModifiable(): bool
	{
		return $this->isModifiable;
	}

	public function setIsModifiable(bool $isModifiable): void
	{
		$this->isModifiable = $isModifiable;
	}

	public function isDeletable(): bool
	{
		return $this->isDeletable;
	}

	public function setIsDeletable(bool $isDeletable): void
	{
		$this->isDeletable = $isDeletable;
	}

}
