<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Repository;

use Lukasojd\DegiroPhp\Entity\Stock;

class StocksRepository
{

	/**
	 * @param Stock[] $stocks
	 */
	public function findStock(array $stocks, string $ticker): ?Stock
	{
		$output = null;
		foreach ($stocks as $stock) {
			if (!($stock instanceof Stock)) {
				continue;
			}

			if ($stock->getSymbol() === $ticker) {
				$output = $stock;
				break;
			}
		}

		return $output;
	}

}
