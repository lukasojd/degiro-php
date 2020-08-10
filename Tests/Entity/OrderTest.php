<?php declare(strict_types = 1);

namespace Tests\Entity;

use Lukasojd\DegiroPhp\Entity\Order;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{

	public function testCreate(): void
	{
		$order = new Order();
		$this->assertInstanceOf(Order::class, $order);
		$order->setId('id');
		$order->setDate('date');
		$order->setProduct('product');
		$order->setProductId(1);
		$order->setContractType(2);
		$order->setContractSize(3.1);
		$order->setCurrency('currency');
		$order->setBuysell('buysell');
		$order->setSize(5);
		$order->setQuantity(6.44);
		$order->setPrice(7);
		$order->setStopPrice(8);
		$order->setTotalOrderValue(9);
		$order->setOrderTypeId(10);
		$order->setOrderTimeTypeId(10);
		$order->setOrderType('orderType');
		$order->setOrderTimeType('orderTimeType');
		$order->setIsModifiable(true);
		$order->setIsDeletable(false);

		$this->assertSame('id', $order->getId());
		$this->assertSame('date', $order->getDate());
		$this->assertSame('product', $order->getProduct());
		$this->assertSame(1, $order->getProductId());
		$this->assertSame(2, $order->getContractType());
		$this->assertSame(3.1, $order->getContractSize());
		$this->assertSame('currency', $order->getCurrency());
		$this->assertSame('buysell', $order->getBuysell());
		$this->assertSame(5.0, $order->getSize());
		$this->assertSame(6.44, $order->getQuantity());
		$this->assertSame(7.0, $order->getPrice());
		$this->assertSame(8.0, $order->getStopPrice());
		$this->assertSame(9.0, $order->getTotalOrderValue());
		$this->assertSame(10, $order->getOrderTypeId());
		$this->assertSame(10, $order->getOrderTimeTypeId());
		$this->assertSame('orderType', $order->getOrderType());
		$this->assertSame('orderTimeType', $order->getOrderTimeType());
		$this->assertTrue($order->isModifiable());
		$this->assertFalse($order->isDeletable());
	}

}
