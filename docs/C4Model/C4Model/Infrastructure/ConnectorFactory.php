<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Infrastructure;

use Psr\Log\NullLogger;
use StructurizrPHP\Client\Client;
use StructurizrPHP\Client\Credentials;
use StructurizrPHP\Client\Infrastructure\Http\SymfonyRequestFactory;
use StructurizrPHP\Client\UrlMap;
use Symfony\Component\HttpClient\Psr18Client;

class ConnectorFactory
{
    public static function create(): Client
    {
        return new Client(
            new Credentials(getenv('STRUCTURIZR_API_KEY'), getenv('STRUCTURIZR_API_SECRET')),
            new UrlMap(getenv('STRUCTURIZR_API')),
            new Psr18Client(),
            new SymfonyRequestFactory(),
            new NullLogger()
        );
    }
}
