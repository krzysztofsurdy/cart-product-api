<?php
declare(strict_types=1);

namespace App\Tests\Unit\Cart\Domain\CommandHandler;

use App\Cart\Application\Service\CartService;
use App\Cart\Command\CreateCartCommand;
use App\Cart\Domain\CommandHandler\CreateCartCommandHandler;
use App\Cart\Infrastructure\CartRepository\InMemory as CartRepository;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateCartCommandHandlerTest extends TestCase
{
    private CartService $cartService;
    private string $cartId;

    protected function setUp(): void
    {
        $this->cartService = $this->getMockBuilder(CartService::class)->disableOriginalConstructor()->getMock();
        $this->cartId = Uuid::uuid1()->toString();
    }

    public function test_can_generate_cart(): void
    {
        // Given
        $cartRepository = new CartRepository();

        $handler = new CreateCartCommandHandler($cartRepository);
        $command = new CreateCartCommand($this->cartId);

        // When
        $handler($command);

        // Then
        $cartData = $cartRepository->get($this->cartId);
        $this->assertNotEmpty($cartData);
        $this->assertEquals($this->cartId, $cartData['id']);
    }
}
