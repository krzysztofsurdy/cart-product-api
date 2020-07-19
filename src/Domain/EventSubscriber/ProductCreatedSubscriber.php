<?php
declare(strict_types=1);

namespace App\Domain\EventSubscriber;

use App\Domain\Event\ProductCreated;
use App\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

final class ProductCreatedSubscriber implements MessageSubscriberInterface
{
    private ProductViewRepositoryInterface $productViewRepository;

    public function __construct(ProductViewRepositoryInterface $productViewRepository)
    {
        $this->productViewRepository = $productViewRepository;
    }

    public static function getHandledMessages(): iterable
    {
        yield ProductCreated::class;
    }

    public function __invoke(ProductCreated $event): void
    {
        $this->productViewRepository->add($event->aggregateId(), $event->getProductData(), $event->createdAt());
    }
}
