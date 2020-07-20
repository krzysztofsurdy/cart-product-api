<?php
declare(strict_types=1);

namespace App\Product\Domain\EventSubscriber;

use App\Product\Domain\Event\ProductDeleted;
use App\Product\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

final class ProductDeletedSubscriber implements MessageSubscriberInterface
{
    private ProductViewRepositoryInterface $productViewRepository;

    public function __construct(ProductViewRepositoryInterface $productViewRepository)
    {
        $this->productViewRepository = $productViewRepository;
    }

    public static function getHandledMessages(): iterable
    {
        yield ProductDeleted::class;
    }

    public function __invoke(ProductDeleted $event): void
    {
        $this->productViewRepository->markDeleted($event->aggregateId(), $event->createdAt());
    }
}
