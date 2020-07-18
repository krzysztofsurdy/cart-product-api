<?php
declare(strict_types=1);

namespace App\SharedKernel\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class PaginatedResponse extends JsonResponse
{
    private string $context;
    private array $items;
    private int $itemsTotal;
    private int $page;
    private int $pages;

    public function __construct()
    {
        parent::__construct([
            'status' => 'OK',
            'data' => [
                'context' => $this->context,
                'items' => $this->items,
                'items_total' => $this->itemsTotal,
                'view' => [

                ]
            ]
        ], JsonResponse::HTTP_OK);
    }
}
