<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Domain\Diagram;

use StructurizrPHP\Core\Model\StaticStructureElement;
use StructurizrPHP\Core\View\StaticView;

interface Diagram
{
    public function generate(): void;

    public function create(StaticStructureElement $element): StaticView;
}
