<?php
declare(strict_types=1);

namespace App\Application\DTO;

use App\Application\DTO\Factory\ProductGetResponseDTOFactory;

final class ProductGetResponseDTO
{
    use ProductGetResponseDTOFactory;

    public const LABEL_ITEMS = 'items';
    public const LABEL_ITEMS_TOTAL = 'items_total';
    public const LABEL_PAGE = 'page';
    public const LABEL_PAGES= 'pages';
    public const LABEL_LIMIT = 'limit';

    private array $items;
    private int $itemsTotal;
    private ?int $page = null;
    private ?int $pages  = null;
    private ?int $limit  = null;

    public function getItems(): array
    {
        return $this->items;
    }

    public function getItemsTotal(): int
    {
        return $this->itemsTotal;
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function getLimit(): ?int
    {
        return $this->limit;
    }

    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    public function setPages(?int $pages): void
    {
        $this->pages = $pages;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }
}
