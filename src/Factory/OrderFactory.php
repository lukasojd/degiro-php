<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Factory;

use Lukasojd\DegiroPhp\Entity\Order;

class OrderFactory
{

	/**
	 * @param mixed[] $data
	 */
	public function create(array $data): Order
	{
		$order = new Order();
		if (isset($data['value']) && is_array($data['value'])) {
			foreach ($data['value'] as $option) {
				if (!isset($option['name']) || !isset($option['value'])) {
					continue;
				}

				$methodName = 'set' . strtolower($option['name']);
				$order->$methodName($option['value']);

			}
		}

		return $order;
	}

}
