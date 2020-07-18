<?php

declare(strict_types=1);

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Predis\ClientInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends CoreController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     */
    public function indexAction(Connection $mysql, ClientInterface $redis): Response
    {
        return $this->createApiResponse(
            true,
            null,
            JsonResponse::HTTP_NO_CONTENT
        );
    }
}
