<?php
declare(strict_types=1);

namespace App\Tests\Unit\Cart\Domain\CommandHandler;

use App\Cart\Application\Service\CartService;
use App\Cart\Command\DeleteCartProductCommand;
use App\Cart\Domain\Cart;
use App\Cart\Domain\CommandHandler\DeleteCartProductCommandHandler;
use App\Cart\Infrastructure\CartRepository\InMemory as CartRepository;
use App\Product\Domain\ProductData;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class DeleteCartProductCommandHandlerTest extends TestCase
{
    private CartService $cartService;
    private Cart $cart;
    private ProductData $productData;

    protected function setUp(): void
    {
        $this->cartService = $this->getMockBuilder(CartService::class)->disableOriginalConstructor()->getMock();
        $this->productData = ProductData::createFromArray([
            'name'  => Uuid::uuid1()->toString(),
            'price' => 1,
            'id'    => Uuid::uuid1()->toString()
        ]);
        $this->cart = Cart::build(Uuid::uuid1()->toString());
        $this->cart->addProduct($this->productData);
    }

    public function test_can_delete_product_from_cart(): void
    {
        // Expect
        $this->cartService->expects($this->once())->method('get')->willReturn($this->cart);

        // Given
        $cartRepository = new CartRepository();
        $handler = new DeleteCartProductCommandHandler($this->cartService, $cartRepository);
        $command = new DeleteCartProductCommand($this->cart->getId(), $this->productData->getId());

        // When
        $handler($command);

        // Then
        $cart = Cart::createFromArray($cartRepository->get($this->cart->getId()));
        $this->assertEquals($this->cart->getId(), $cart->getId());
        $this->assertIsArray($cart->getProducts());
        $this->assertEmpty($cart->getProducts());
    }
}
