<?php
declare(strict_types=1);

namespace App\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"}, name="index")
     * @return Response
     */
    public function indexAction(Request $request)
    {
        // TODO IMPLEMENT
    }
}
