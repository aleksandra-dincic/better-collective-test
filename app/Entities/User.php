<?php

namespace App\Entities;

use App\Support\ArrayableInterface;
use Carbon\Carbon;

class User implements ArrayableInterface
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var Carbon
     */
    private Carbon $yearOfBirth;

    /**
     * @var Carbon
     */
    private Carbon $createdAt;

    public function __construct(
        int $id,
        string $name,
        Carbon $yearOfBirth,
        Carbon $createdAt,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->yearOfBirth = $yearOfBirth;
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Carbon
     */
    public function getYearOfBirth(): Carbon
    {
        return $this->yearOfBirth;
    }

    /**
     * @param Carbon $yearOfBirth
     */
    public function setYearOfBirth(Carbon $yearOfBirth): void
    {
        $this->yearOfBirth = $yearOfBirth;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'year_of_birth' => $this->yearOfBirth,
            'created_at' => $this->createdAt->toISOString()
        ];
    }
}
