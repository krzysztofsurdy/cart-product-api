<?php
declare(strict_types=1);

namespace App\SharedKernel\SymfonyCommand;

use App\Product\Application\DTO\ProductAddRequestDTO;
use App\Product\Application\Service\ProductService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class InitCommand extends Command
{
    protected static $defaultName = 'system:init';

    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        parent::__construct();
        $this->productService = $productService;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($application = $this->getApplication()) {
            $migrateCommand = $application->find('doctrine:migrations:migrate');
            $migrateCommand->run($input, $output);

            foreach ($this->provideInitProducts() as $productData) {
                $this->productService->add(ProductAddRequestDTO::createFromArray($productData));
            }
        }

        return 0;
    }

    private function provideInitProducts(): array
    {
        return [
            [
                'name'  => 'Fallout',
                'price' => 1.99
            ],
            [
                'name'  => 'Don\'t Starve',
                'price' => 2.99
            ],
            [
                'name'  => 'Baldur\'s Gate',
                'price' => 3.99
            ],
            [
                'name'  => 'Icewind Dale',
                'price' => 4.99
            ],
            [
                'name'  => 'Bloodborne',
                'price' => 5.99
            ]
        ];
    }
}
