<?php

declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\DTO\Factory\ProductGetRequestDTOFactory;

final class ProductGetRequestDTO
{
    use ProductGetRequestDTOFactory;

    public const LABEL_PAGE = 'page';
    public const LABEL_LIMIT = 'limit';

    private ?int $page;
    private ?int $limit;

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }
}
