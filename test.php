<?php declare(strict_types = 1);

use Lukasojd\DegiroPhp\Client;
use Lukasojd\DegiroPhp\Config;
use Lukasojd\DegiroPhp\DegiroApi;

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['LOGIN', 'PASSWORD']);

$config = new Config($_ENV['LOGIN'], $_ENV['PASSWORD']);
$client = new Client();
$degiroApi = new DegiroApi($client);
$degiroApi->login($config);
$config = $degiroApi->getDegiroConfig();