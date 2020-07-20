<?php
declare(strict_types=1);

namespace App\Product\Domain\EventSubscriber;

use App\Product\Domain\Event\ProductNameChanged;
use App\Product\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

final class ProductNameChangedSubscriber implements MessageSubscriberInterface
{
    private ProductViewRepositoryInterface $productViewRepository;

    public function __construct(ProductViewRepositoryInterface $productViewRepository)
    {
        $this->productViewRepository = $productViewRepository;
    }

    public static function getHandledMessages(): iterable
    {
        yield ProductNameChanged::class;
    }

    public function __invoke(ProductNameChanged $event): void
    {
        $this->productViewRepository->changeName($event->aggregateId(), $event->getName());
    }
}
