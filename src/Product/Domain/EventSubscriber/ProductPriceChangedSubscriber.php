<?php
declare(strict_types=1);

namespace App\Product\Domain\EventSubscriber;

use App\Product\Domain\Event\ProductPriceChanged;
use App\Product\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

final class ProductPriceChangedSubscriber implements MessageSubscriberInterface
{
    private ProductViewRepositoryInterface $productViewRepository;

    public function __construct(ProductViewRepositoryInterface $productViewRepository)
    {
        $this->productViewRepository = $productViewRepository;
    }

    public static function getHandledMessages(): iterable
    {
        yield ProductPriceChanged::class;
    }

    public function __invoke(ProductPriceChanged $event): void
    {
        $this->productViewRepository->changePrice($event->aggregateId(), $event->getPrice());
    }
}
