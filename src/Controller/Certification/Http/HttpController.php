<?php
declare(strict_types=1);

namespace App\Controller\Certification\Http;

use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/certification")
 */
class HttpController
{
    public function __construct()
    {
    }

    /**
     * @Route(path="/main", name="http_main")
     * @param Request $request
     * @return Response
     */
    public function mainAction(Request $request): Response
    {
        $i=0;
    }
}