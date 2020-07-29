<?php declare(strict_types = 1);

namespace Tests;

use Lukasojd\DegiroPhp\Client;
use Lukasojd\DegiroPhp\Exception\StatusCodeException;
use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

	use PHPMock;

	private Client $client;

	public function setUp(): void
	{
		$this->client = new Client();
	}

	public function testExecutePost(): void
	{
		$curl_exec = $this->getFunctionMock('Lukasojd\DegiroPhp', 'curl_exec');
		$curl_exec->expects($this->once())->willReturn('body');

		$curl_getinfo = $this->getFunctionMock('Lukasojd\DegiroPhp', 'curl_getinfo');
		$curl_getinfo->expects($this->once())->willReturn(['http_code' => 200]);

		$this->assertSame('body', $this->client->execute('test', ['test' => 'pes']));
	}

	public function testExecuteGet(): void
	{
		$curl_exec = $this->getFunctionMock('Lukasojd\DegiroPhp', 'curl_exec');
		$curl_exec->expects($this->once())->willReturn('body');

		$curl_getinfo = $this->getFunctionMock('Lukasojd\DegiroPhp', 'curl_getinfo');
		$curl_getinfo->expects($this->once())->willReturn(['http_code' => 200]);

		$this->assertSame('body', $this->client->execute('test'));
	}

	public function testExecuteException(): void
	{
		$this->expectException(StatusCodeException::class);
		$curl_exec = $this->getFunctionMock('Lukasojd\DegiroPhp', 'curl_exec');
		$curl_exec->expects($this->once())->willReturn('body');

		$curl_getinfo = $this->getFunctionMock('Lukasojd\DegiroPhp', 'curl_getinfo');
		$curl_getinfo->expects($this->once())->willReturn(['http_code' => 500]);

		$this->client->execute('test');
	}

}
