<?php

declare(strict_types=1);

namespace App\Product\Application\Command;

final class DeleteProductCommand
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
