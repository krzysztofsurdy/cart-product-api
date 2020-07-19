<?php
declare(strict_types=1);

namespace App\Tests\Application\Command;

use App\Application\Command\AddProductCommand;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Application\Command\AddProductCommand
 */
class AddProductCommandTest extends TestCase
{
    /**
     * @dataProvider getTestCases
     */
    public function testShouldCreateAddProductCommand(string $name, float $price): void
    {
        // When
        $command = new AddProductCommand($name, $price);

        // Then
        $this->assertIsString($command->getName());
        $this->assertEquals($name, $command->getName());
        $this->assertIsFloat($command->getPrice());
        $this->assertEquals($price, $command->getPrice());
    }

    public function getTestCases(): array
    {
        return [
            [
                'test',
                11.11
            ],
            [
                'test',
                11
            ],
            [
                'test',
                0
            ]
        ];
    }
}
