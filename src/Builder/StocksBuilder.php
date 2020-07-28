<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Builder;

use Lukasojd\DegiroPhp\Factory\StockFactory;

class StocksBuilder
{

	/**
	 * @return mixed[]
	 */
	public function build(string $json): array
	{
		$data = json_decode($json, true);
		$stockFactory = new StockFactory();
		$products = [];

		if (isset($data['products']) && is_array($data['products'])) {
			foreach ($data['products'] as $product) {
				$products[] = $stockFactory->create($product);
			}
		}

		return $products;
	}

}
