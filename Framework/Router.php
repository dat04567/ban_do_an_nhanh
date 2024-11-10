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
  protected array $dynamicRoutes = [];


  private function sanitizeUri($uri)
  {
    // Remove multiple forward slashes
    $uri = preg_replace('#/+#', '/', $uri);

    // Remove trailing slash
    $uri = rtrim($uri, '/');

    // Remove any .. or unsafe characters
    $uri = str_replace(['..', './'], '', $uri);

    // Ensure leading slash
    if (strpos($uri, '/') !== 0) {
      $uri = '/' . $uri;
    }

    return $uri;
  }

  /**
   * Convert URI to regex pattern
   *
   * @param string $uri
   * @return string
   */
  private function convertUriToPattern($uri)
  {
    // Convert {parameter} to named capture group (?P<parameter>[^/]+)
    return preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $uri);
  }


  /**
   * Add a new route
   *
   * @param string $method
   * @param string $uri
   * @param string $action
   * @param array $middleware
   * 
   * 
   * @return void
   */

  public function registerRoute($method, $uri, $action, $middleware = [])
  {
    // Sanitize URI
    $uri = $this->sanitizeUri($uri);

    $routeKey = strtoupper($method) . ' ' . $uri;

    list($controller, $controllerMethod) = explode('@', $action);

    $this->routes[$routeKey] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod,
      'middleware' => $middleware,
      'pattern' => $this->convertUriToPattern($uri)
    ];
  }

  /**
   * Extract parameters from URI based on pattern
   *
   * @param string $pattern
   * @param string $uri
   * @return array|null
   */
  private function extractParameters($pattern, $uri)
  {
    $pattern = '#^' . $pattern . '$#';
    if (preg_match($pattern, $uri, $matches)) {
      // Remove numeric keys
      return array_filter($matches, function ($key) {
        return !is_numeric(value: $key);
      }, ARRAY_FILTER_USE_KEY);
      
    }
    return null;
  }


  public function __call($method, $arguments)
  {
    $httpMethods = ['get', 'post', 'put', 'delete', 'patch', 'options'];
    $uri = $arguments[0];
    $controller = $arguments[1];
    $middleware = $arguments[2] ?? [];


    $uri = $this->sanitizeUri($uri);


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
    $path = $this->sanitizeUri(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    // Tạo khóa route sử dụng phương thức và URI
    $routeKey = $requestMethod . ' ' . $path;



    // Tìm route phù hợp
    if (isset($this->routes[$routeKey])) {
      $route = $this->routes[$routeKey];
      $parameters = [];
    } else {

      $route = null;
      $parameters = [];



      foreach ($this->routes as $registeredRoute) {
        if ($registeredRoute['method'] !== $requestMethod) {
          continue;
        }

        $params = $this->extractParameters($registeredRoute['pattern'], $path);
      
        if ($params !== null) {
          $route = $registeredRoute;
          $parameters = $params;
          break;
        }
      }



      // Xử lý lỗi 404 Not Found
      if (!$route) {
        ErrorController::notFound();
        return;
      }
    }

    // Xác định namespace của controller dựa trên đường dẫn
    if (strpos($path, '/admin') === 0) {
      $controllerClass = 'App\\Controllers\\admin\\' . $route['controller'];
    } else {
      $controllerClass = 'App\\Controllers\\client\\' . $route['controller'];
    }

    // Khởi tạo controller và gọi phương thức
    $controllerInstance = new $controllerClass();
    $controllerMethod = $route['controllerMethod'];

    // Gọi phương thức của controller
    $controllerInstance->$controllerMethod($parameters);
  }
}
