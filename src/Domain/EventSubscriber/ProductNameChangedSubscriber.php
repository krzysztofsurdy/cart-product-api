<?php
declare(strict_types=1);

namespace App\Domain\EventSubscriber;

use App\Domain\Event\ProductNameChanged;
use App\Infrastructure\ProductViewRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;

class ProductNameChangedSubscriber implements MessageSubscriberInterface
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