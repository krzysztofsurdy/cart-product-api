<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Application;

use App\Docs\C4Model\C4Model\Domain\Generator;

class GeneratorService
{
    /** @var Generator */
    private $generator;

    public function __construct()
    {
        $this->generator = new Generator();
    }

    public function run(): void
    {
        $this->generator->generate();
    }
}
