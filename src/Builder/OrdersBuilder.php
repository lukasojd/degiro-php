<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Builder;

use Lukasojd\DegiroPhp\Entity\Order;
use Lukasojd\DegiroPhp\Factory\OrderFactory;

class OrdersBuilder
{

	/**
	 * @return Order[]
	 */
	public function build(string $json): array
	{
		$data = json_decode($json, true);
		$orders = [];
		$orderFactory = new OrderFactory();

		if (isset($data['orders']['value']) && is_array($data['orders']['value'])) {
			foreach ($data['orders']['value'] as $order) {
				$orders[] = $orderFactory->create($order);
			}
		}

		return $orders;
	}

}
