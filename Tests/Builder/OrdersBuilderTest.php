<?php declare(strict_types = 1);

namespace Tests\Builder;

use Lukasojd\DegiroPhp\Builder\OrdersBuilder;
use Lukasojd\DegiroPhp\Entity\Order;
use PHPUnit\Framework\TestCase;

class OrdersBuilderTest extends TestCase
{

	private OrdersBuilder $ordersBuilder;

	public function setUp(): void
	{
		$this->ordersBuilder = new OrdersBuilder();
	}

	public function testBuild(): void
	{
		$data = file_get_contents(__DIR__ . '/../Fixtures/orders.json') ?: '';
		$orders = $this->ordersBuilder->build($data);
		$this->assertCount(1, $orders);
		$firstOrder = reset($orders);
		$this->assertInstanceOf(Order::class, $firstOrder);
	}

}
