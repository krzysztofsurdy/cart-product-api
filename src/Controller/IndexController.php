<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class IndexController extends CoreController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('docs');
    }
}
