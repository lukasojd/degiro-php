<?php declare(strict_types = 1);

namespace Tests\Factory;

use Lukasojd\DegiroPhp\Builder\OrdersBuilder;
use Lukasojd\DegiroPhp\Entity\Order;
use Lukasojd\DegiroPhp\Factory\OrderFactory;
use PHPUnit\Framework\TestCase;

class OrderFactoryTest extends TestCase
{

	private OrderFactory $orderFactory;

	public function setUp(): void
	{
		$this->orderFactory = new OrderFactory();
	}

	public function testCreate(): void
	{
		$orderBuilder = new OrdersBuilder();
		$data = file_get_contents(__DIR__ . '/../Fixtures/orders.json') ?: '';
		$orders = $orderBuilder->build($data);
		$this->assertCount(1, $orders);
		$firstOrder = reset($orders);
		$exceptedOrder = new Order();
		$exceptedOrder->setId('test');
		$exceptedOrder->setDate('07/08');
		$exceptedOrder->setProduct('APACHE CORP');
		$exceptedOrder->setProductId(1170740);
		$exceptedOrder->setContractType(1);
		$exceptedOrder->setContractSize(1.0);
		$exceptedOrder->setCurrency('USD');
		$exceptedOrder->setBuysell('S');
		$exceptedOrder->setSize(20.0);
		$exceptedOrder->setQuantity(20.0);
		$exceptedOrder->setPrice(15.99);
		$exceptedOrder->setStopPrice(0.0);
		$exceptedOrder->setTotalOrderValue(319.8);
		$exceptedOrder->setOrderTimeTypeId(3);
		$exceptedOrder->setOrderTypeId(0);
		$exceptedOrder->setOrderType('LIMIT');
		$exceptedOrder->setOrderTimeType('GTC');
		$exceptedOrder->setIsModifiable(true);
		$exceptedOrder->setIsDeletable(true);

		$this->assertEquals($firstOrder, $exceptedOrder);
	}

	public function testCreateWithNonExistData(): void
	{
		$order = new Order();
		$emptyOrder = $this->orderFactory->create(['value' => ['test']]);
		$this->assertEquals($order, $emptyOrder);
	}

}
