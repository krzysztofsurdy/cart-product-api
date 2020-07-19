<?php
declare(strict_types=1);

namespace App\Tests\Application\Command;

use App\Application\Command\DeleteProductCommand;
use PHPUnit\Framework\TestCase;

class DeleteProductCommandTest extends TestCase
{
    /**
     * @dataProvider getTestCases
     */
    public function testShouldCreateDeleteProductCommand(string $id): void
    {
        // When
        $command = new DeleteProductCommand($id);

        // Then
        $this->assertIsString($command->getId());
        $this->assertEquals($id, $command->getId());
    }

    public function getTestCases(): array
    {
        return [
            [
                'test'
            ]
        ];
    }
}
