<?php
declare(strict_types=1);

namespace App\Domain\EventSubscriber;

use App\Domain\Event\ProductPriceChanged;
use App\Infrastructure\ProductViewRepositoryInterface;
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
