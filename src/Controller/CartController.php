<?php
declare(strict_types=1);

namespace App\Controller;

use App\Product\Application\DTO\ProductAddRequestDTO;
use App\Product\Application\DTO\ProductDeleteRequestDTO;
use App\Product\Application\DTO\ProductGetRequestDTO;
use App\Product\Application\DTO\ProductUpdateRequestDTO;
use App\Product\Application\Service\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends CoreController
{

}
