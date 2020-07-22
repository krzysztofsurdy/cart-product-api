<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Domain\Diagram;

use App\Docs\C4Model\C4Model\Domain\CartProductApiWorkspace;
use App\Docs\C4Model\C4Model\Domain\Diagram\ComponentDiagrams\CartComponentDiagram;
use App\Docs\C4Model\C4Model\Domain\Diagram\ComponentDiagrams\ProductComponentDiagram;

class DiagramFactory
{
    /** @var Diagram[] */
    private array $diagrams;

    public function __construct(CartProductApiWorkspace $workspace)
    {
        $this->diagrams = [
            new ContextDiagram($workspace),
            new ProductComponentDiagram($workspace),
            new CartComponentDiagram($workspace)
        ];
    }

    public function run(): void
    {
        foreach ($this->diagrams as $diagram) {
            $diagram->generate();
        }
    }
}
