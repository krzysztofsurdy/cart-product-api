<?php

declare(strict_types=1);

namespace App\Application\Query;

final class GetProductsQuery
{
    private int $page;
    private int $limit;

    public function __construct(int $page, int $limit)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
