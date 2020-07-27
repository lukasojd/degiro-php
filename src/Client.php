<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp;

use Lukasojd\DegiroPhp\Exception\StatusCodeException;

class Client
{

	private ?string $cookiePath;

	public function __construct(?string $cookiePath = null)
	{
		$this->cookiePath = $cookiePath ?? __DIR__ . '/cookie.txt';
	}

	/**
	 * @param mixed[] $params
	 * @throws StatusCodeException
	 */
	public function execute(string $url, array $params = []): string
	{
		$ch = curl_init();

		$headers = $this->getHeaders();

		$curlArray = [
			CURLOPT_URL => $url,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_COOKIEFILE => $this->cookiePath,
			CURLOPT_COOKIEJAR => $this->cookiePath,
			CURLOPT_POST => false,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
			CURLOPT_ENCODING => '',
		];

		if (count($params) > 0) {
			$paramsString = json_encode($params);
			$curlArray[CURLOPT_POSTFIELDS] = $paramsString;
		}

		curl_setopt_array($ch, $curlArray);

		$result = curl_exec($ch);
		$info = curl_getinfo($ch);

		if ($info['http_code'] !== 200 && $info['http_code'] !== 201) {
			throw new StatusCodeException('Error code from API', $info['http_code']);
		}

		$result = is_string($result)
			? $result
			: '';

		return $result;
	}

	/**
	 * @return mixed[]
	 */
	private function getHeaders(): array
	{
		$headers = [];
		$headers[] = 'application/json, text/plain, */*';
		$headers[] = 'Accept-Language: cs,sk;q=0.8,en-US;q=0.5,en;q=0.3';
		$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36';
		$headers[] = 'Content-Type: application/json';
		$headers[] = 'Referer: https://trader.degiro.nl/login/pt';
		$headers[] = 'Authority: trader.degiro.nl';
		$headers[] = 'Dnt: 1';

		return $headers;
	}

}
