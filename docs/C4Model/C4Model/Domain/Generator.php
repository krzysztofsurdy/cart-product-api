<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Domain;


use App\Docs\C4Model\C4Model\Domain\Diagram\DiagramFactory;
use App\Docs\C4Model\C4Model\Infrastructure\Connector;

class Generator
{
    private Connector $connector;
    private CartProductApiWorkspace $workspace;

    public function __construct()
    {
        $this->connector = new Connector();
        $this->workspace = new CartProductApiWorkspace();
    }

    public function generate(): void
    {
        $diagramFactory = new DiagramFactory($this->workspace);
        $diagramFactory->run();
        $this->connector->put($this->workspace);
    }
}
