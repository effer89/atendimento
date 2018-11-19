<?php declare(strict_types = 1);

namespace Atendimento;

error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

$environment = 'development';

/**
 * BaseURL
 */
// TODO melhorar gerenciamento desse path
//define('baseUrl', 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
define('baseUrl', 'http://'.$_SERVER['SERVER_NAME'].'/atendimento/public');

/**
 * Register the error handler
 */
$whoops = new \Whoops\Run;
if ($environment !== 'production') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function($e){
        echo 'Todo: Friendly error page and send an email to the developer';
    });
}
$whoops->register();

/**
 * Doctrine
 */
$paths = array('../src/Entity');
$isDevMode = true;

// the connection configuration
$dbParams = include('Db.php');

$config = \Doctrine\ORM\Tools\Setup::createConfiguration($isDevMode);
$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver(new \Doctrine\Common\Annotations\AnnotationReader(), $paths);

// registering noop annotation autoloader - allow all annotations by default
\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
$config->setMetadataDriverImpl($driver);
$entityManager = \Doctrine\ORM\EntityManager::create($dbParams, $config);

/**
 * Register request & response handler
 */
$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new \Http\HttpResponse();

foreach($response->getHeaders() as $header){
    header($header, false);
}

/**
 * Register view
 */
$viewFactory = new \Aura\View\ViewFactory();
$view = $viewFactory->newInstance();
$viewRegistry = $view->getViewRegistry();
$layoutRegistry = $view->getLayoutRegistry();
$layoutRegistry->set('default', '../src/View/Layout/default.php');
$view->setLayout('default');

/**
 * Include the routes file and added to router
 */
$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include('Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};
$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

// TODO melhorar gerenciamento desse path
$path = str_replace('/atendimento/public', '', $request->getPath());
$routeInfo = $dispatcher->dispatch($request->getMethod(), $path);
switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
        $className = $routeInfo[1][0];
        $method = $routeInfo[1][1];
        $vars = $routeInfo[2];
        $controllerName = explode('\\', $className)[2];

        // Setting view
        $viewRegistry->set('view', '../src/View/'.$controllerName.'/'.strtolower($method).'.php');
        $view->setView('view');

        $class = new $className($view, $entityManager);
        $class->$method($vars);
        break;
}

print $view();