<?php

/**
 *  Route class
 *  by Ho Tan Dat
 */

namespace Framework;

use App\Controllers\ErrorController;


class Router
{
  protected array $routes = [];

  /**
   * Add a new route
   *
   * @param string $method
   * @param string $uri
   * @param string $action
   * @param array $middleware
   * 
   * @return void
   */
  public function registerRoute($method, $uri, $action, $middleware = [])
  {
    list($controller, $controllerMethod) = explode('@', $action);

    $this->routes[] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod,
      'middleware' => $middleware
    ];
  }


  public function __call($method, $arguments)
  {
    $httpMethods = ['get', 'post', 'put', 'delete', 'patch', 'options'];
    $uri = $arguments[0];
    $controller = $arguments[1];
    $middleware = $arguments[2] ?? [];

    if (strpos($uri, '/') !== 0) {
      $uri = '/' . $uri;
    }

    if (in_array(strtolower($method), $httpMethods)) {

      $this->registerRoute(strtoupper($method), $uri, $controller, $middleware);
    } else {
      throw new \BadMethodCallException("Method $method does not exist");
    }
  }


  /**
   * Route the request
   * 
   * @param string $uri
   * @param string $method
   * @return void
   */


  public function route()
  {
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $uri = parse_url($_SERVER['REQUEST_URI']);
    if ($uri === false) {
      http_response_code(400);
      return;
    }

    $path = $uri['path'];

    $query =  $uri['query'] ?? '';
    // Check for _method input
    if ($requestMethod === 'POST' && isset($_POST['_method'])) {
      // Override the request method with the value of _method
      $requestMethod = strtoupper($_POST['_method']);
    }

    $queryParams = [];
    if ($query) {
      parse_str($query, $queryParams);
    }

    $route = null;
    $params = [];


    foreach ($this->routes as $r) {

      // Thay thế các tham số đường dẫn bằng biểu thức chính quy
      $routePattern = preg_replace('/:[^\/]+/', '([^/]+)', $r['uri']);
      // Thêm dấu gạch chéo vào đầu mẫu đường dẫn
      $routePattern = '/^' . str_replace('/', '\/', $routePattern) . '$/';
      if (preg_match($routePattern, $path, $matches)) {
        array_shift($matches); // Remove the full match
        $route = $r;
        preg_match_all('/:([^\/]+)/', $r['uri'], $paramNames);
        $paramNames = $paramNames[1];
        $params = array_combine($paramNames, $matches);
      }
    }
    
    if (!$route) {
      ErrorController::notFound();
      return;
    }

    // Check path admin or client
    if (strpos($path, '/admin') === 0) {
      $controller = 'App\\controllers\\admin\\' . $route['controller'];

      // Instatiate the controller and call the method
      $controllerInstance = new $controller();
    } else {
      $controller = 'App\\Controllers\\client\\' . $route['controller'];

      // Instatiate the controller and call the method
      $controllerInstance = new $controller();
    }

    $controllerMethod = $route['controllerMethod'];


    $request = [
      'params' => $params,
      'query' => $queryParams
    ];

    $controllerInstance->$controllerMethod($request);
  }
}
