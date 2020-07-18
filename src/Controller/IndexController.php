<?php

declare(strict_types=1);

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Predis\ClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     */
    public function indexAction(Connection $mysql, ClientInterface $redis): Response
    {
        return new JsonResponse([
            'status' => [
                'mysql' => [
                    'status' => $mysql->ping(),
                    'details' => $mysql->getParams()
                ],
                'redis' => [
                    'status' => $redis->ping() ? true : false,
                    'details' => $redis->getOptions()
                ]
            ]
        ]);
    }
}
