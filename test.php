<?php declare(strict_types = 1);

use Lukasojd\DegiroPhp\Config;
use Lukasojd\DegiroPhp\Api\DegiroApi;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['LOGIN', 'PASSWORD']);

$config = new Config($_ENV['LOGIN'], $_ENV['PASSWORD']);
$degiroApi = new DegiroApi($config);
$stock = $degiroApi->getStockByTickerFromIndex('AAPL');
$degiroApi->placeOrder($stock, 1, $stock->getClosePrice());
//$degiroApi->placeOrder('331868',1,380);
//$degiroApi->getOpenOrders();
