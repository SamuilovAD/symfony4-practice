<?php

declare(strict_types=1);

namespace  App\Controller\Grow;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RoutingController
 * @package App\Controller\Grow
 * @Route("/grow/routing")
 */
class RoutingController extends AbstractController
{
    /**
     * @Route("/", name="Grow_routing1")
     * @Route("/route1", name="Grow_routing1_1")
     * @Route("/route1_additional", name="Grow_routing1_2")
     */
    public function testRouting1(): Response
    {
        return new Response("Action for route 1.");
    }

    /**
     * @Route("/route2/{slug<\d+>?}", name="Grow_routing2")
     */
    public function testRouting2($slug): Response
    {
        return new Response("Slug '$slug' for route 2.");
    }

    public function testRouting3($slug): Response
    {
        return new Response("Шлак ".$slug);
    }


}