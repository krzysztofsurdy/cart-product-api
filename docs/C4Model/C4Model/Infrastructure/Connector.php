<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Infrastructure;

use App\Docs\C4Model\C4Model\Domain\CartProductApiWorkspace;
use StructurizrPHP\Client\Client;
class Connector
{
    /** @var Client */
    private $client;

    public function __construct()
    {
        $this->client = ConnectorFactory::create();
    }

    public function put(CartProductApiWorkspace $workspace): void
    {
        $this->client->put($workspace->get());
    }
}
