<?php
// config/routes.php
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use \App\Controller\Grow\RoutingController;

$routes = new RouteCollection();

$routes->add('route2_additional',
    new Route('/route2_additional/{slug}',
        [
        '_controller' => 'RoutingController::testRouting2'
        ]
    )
);

return $routes;