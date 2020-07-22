<?php
declare(strict_types=1);

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Predis\ClientInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/v1/system")
 */
final class SystemController extends CoreController
{
    /**
     * @Route(path="/healthcheck", methods={"GET"})
     */
    public function healthcheckAction(ClientInterface $redis, Connection $mysql): Response
    {
        return self::createSuccessApiResponse(
            [
                'mysql' => [
                    'status' => $mysql->ping(),
                    'data'   => $mysql->getParams()
                ],
                'redis' => [
                    'status' => $redis->ping() === [] ? true : false,
                    'data'   => $redis->getOptions()
                ]
            ]
        );
    }


    /**
     * @Route("/docs", methods={"GET"}, name="docs")
     */
    public function getDocsAction(): Response
    {
        return $this->render('/Swagger/docs.html');
    }
}
