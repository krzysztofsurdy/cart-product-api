<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Domain;

interface TechnologyInterface
{
    public const NULL = '';

    public const HTTP = 'HTTP';
    public const RABBIT = 'RabbitMQ';
    public const SMTP = 'SMTP';

    public const CONTROLLER = 'Controller';
    public const SERVICE = 'Service';
    public const DTO = 'DTO';
    public const FACTORY = 'Factory';
    public const VALIDATOR = 'Validator';
    public const CONSOLE_COMMAND = 'Console Command';
    public const CONSUMER = 'Consumer';
    public const SUBDOMAIN = 'Subdomain';
}
