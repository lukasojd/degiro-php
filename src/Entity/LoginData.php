<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Entity;

class LoginData
{

	private ?string $sessionId = null;

	private ?string $locale = null;

	public function getSessionId(): ?string
	{
		return $this->sessionId;
	}

	public function setSessionId(?string $sessionId): void
	{
		$this->sessionId = $sessionId;
	}

	public function getLocale(): ?string
	{
		return $this->locale;
	}

	public function setLocale(?string $locale): void
	{
		$this->locale = $locale;
	}

}
