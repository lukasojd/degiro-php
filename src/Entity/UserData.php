<?php declare(strict_types = 1);

namespace Lukasojd\DegiroPhp\Entity;

class UserData
{

	protected int $id;

	protected int $intAccount;

	protected string $clientRole;

	protected string $effectiveClientRole;

	protected string $contractType;

	protected string $username;

	protected string $displayName;

	protected string $email;

	public function getId(): int
	{
		return $this->id;
	}

	public function setId(int $id): void
	{
		$this->id = $id;
	}

	public function getIntAccount(): int
	{
		return $this->intAccount;
	}

	public function setIntAccount(int $intAccount): void
	{
		$this->intAccount = $intAccount;
	}

	public function getClientRole(): string
	{
		return $this->clientRole;
	}

	public function setClientRole(string $clientRole): void
	{
		$this->clientRole = $clientRole;
	}

	public function getEffectiveClientRole(): string
	{
		return $this->effectiveClientRole;
	}

	public function setEffectiveClientRole(string $effectiveClientRole): void
	{
		$this->effectiveClientRole = $effectiveClientRole;
	}

	public function getContractType(): string
	{
		return $this->contractType;
	}

	public function setContractType(string $contractType): void
	{
		$this->contractType = $contractType;
	}

	public function getUsername(): string
	{
		return $this->username;
	}

	public function setUsername(string $username): void
	{
		$this->username = $username;
	}

	public function getDisplayName(): string
	{
		return $this->displayName;
	}

	public function setDisplayName(string $displayName): void
	{
		$this->displayName = $displayName;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

}
