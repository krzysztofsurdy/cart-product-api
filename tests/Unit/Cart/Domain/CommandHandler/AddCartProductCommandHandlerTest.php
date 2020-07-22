<?php
declare(strict_types=1);

namespace App\Tests\Unit\Cart\Domain\CommandHandler;

use App\Cart\Application\Command\AddCartProductCommand;
use App\Cart\Application\Service\CartService;
use App\Cart\Domain\Cart;
use App\Cart\Domain\CartProduct;
use App\Cart\Domain\CommandHandler\AddCartProductCommandHandler;
use App\Cart\Infrastructure\CartRepository\InMemory as CartRepository;
use App\Product\Domain\ProductData;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class AddCartProductCommandHandlerTest extends TestCase
{
    private CartService $cartService;
    private string $cartId;

    protected function setUp(): void
    {
        $this->cartService = $this->getMockBuilder(CartService::class)->disableOriginalConstructor()->getMock();
        $this->cartId = Uuid::uuid1()->toString();
    }

    public function test_can_add_product_to_cart(): void
    {


        // Expect
        $this->cartService->expects($this->once())->method('get')->willReturn(Cart::build($this->cartId));

        // Given
        $cartRepository = new CartRepository();
        $productData = $this->createProductData();
        $handler = new AddCartProductCommandHandler($this->cartService, $cartRepository);
        $command = new AddCartProductCommand($this->cartId, $productData);

        // When
        $handler($command);

        // Then

        $cart = Cart::createFromArray($cartRepository->get($this->cartId));

        $this->assertEquals($this->cartId, $cart->getId());
        $this->assertCount(1, $cart->getProducts());
        $this->assertEquals(1, $cart->getProductsQuantity());
        $this->assertEquals($productData->getPrice(), $cart->getValue());
    }


    private function createProductData(): ProductData
    {
        return ProductData::createFromArray([
            'name'  => Uuid::uuid1()->toString(),
            'price' => 1,
            'id'    => Uuid::uuid1()->toString()
        ]);
    }
}
