<?php

namespace Framework;

use App\Controllers\ErrorController;
use Exception;
use Framework\middleware\AuthMiddleware;
use Framework\middleware\MiddlewareInterface;

class Router
{
  protected array $routes = [];
  protected array $controllerNamespaces = [
    'admin' => 'App\\Controllers\\admin\\',
    'public' => 'App\\Controllers\\public\\',
    'api' => 'App\\Controllers\\api\\',
    'default' => 'App\\Controllers\\'
  ];

  private function sanitizeUri($uri)
  {
    $uri = preg_replace('#/+#', '/', $uri);
    $uri = rtrim($uri, '/');
    $uri = str_replace(['..', './'], '', $uri);
    if (strpos($uri, '/') !== 0) {
      $uri = '/' . $uri;
    }
    return $uri;
  }

  private function convertUriToPattern($uri)
  {
    return preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $uri);
  }

  /**
   * Đăng ký route với namespace cụ thể
   *
   * @param string $method HTTP method
   * @param string $uri URI pattern
   * @param string $action Controller action (có thể bao gồm namespace)
   * @param array $middleware Middleware array
   * @return void
   */
  public function registerRoute($method, $uri, $action, $middleware = [])
  {
    $uri = $this->sanitizeUri($uri);
    $routeKey = strtoupper($method) . ' ' . $uri;

    // Phân tích action để lấy namespace, controller và method
    $this->parseAction($action, $controller, $controllerMethod, $namespace);

    $this->routes[$routeKey] = [
      'method' => $method,
      'uri' => $uri,
      'controller' => $controller,
      'controllerMethod' => $controllerMethod,
      'namespace' => $namespace,
      'middleware' => $middleware,
      'pattern' => $this->convertUriToPattern($uri)
    ];
  }

  /**
   * Phân tích chuỗi action để lấy namespace, controller và method
   *
   * @param string $action Chuỗi action (ví dụ: "admin::UserController@index")
   * @param string &$controller Biến tham chiếu để lưu tên controller
   * @param string &$method Biến tham chiếu để lưu tên method
   * @param string &$namespace Biến tham chiếu để lưu namespace
   */
  private function parseAction($action, &$controller, &$method, &$namespace)
  {
    // Kiểm tra xem action có chứa namespace không (format: "namespace::Controller@method")
    if (strpos($action, '::') !== false) {
      list($namespace, $controllerAction) = explode('::', $action);
      list($controller, $method) = explode('@', $controllerAction);
    } else {
      // Nếu không có namespace, sử dụng namespace mặc định
      list($controller, $method) = explode('@', $action);
      $namespace = 'default';
    }
  }

  private function extractParameters($pattern, $uri)
  {
    $pattern = '#^' . $pattern . '$#';
    if (preg_match($pattern, $uri, $matches)) {
      return array_filter($matches, function ($key) {
        return !is_numeric($key);
      }, ARRAY_FILTER_USE_KEY);
    }
    return null;
  }

  /**
   * Magic method để hỗ trợ các HTTP method
   */
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
   * Thêm namespace mới
   *
   * @param string $key Khóa để xác định namespace
   * @param string $namespace Đường dẫn namespace
   */
  public function addNamespace($key, $namespace)
  {
    $namespace = rtrim($namespace, '\\') . '\\';
    $this->controllerNamespaces[$key] = $namespace;
  }

  /**
   * Khởi tạo controller dựa trên namespace
   *
   * @param string $controller Tên controller
   * @param string $namespace Key của namespace
   * @return object|null
   */
  private function instantiateController($controller, $namespace)
  {
    if (!isset($this->controllerNamespaces[$namespace])) {
      throw new \RuntimeException("Namespace '$namespace' not registered");
    }

    $fullClassName = $this->controllerNamespaces[$namespace] . $controller;

    if (!class_exists($fullClassName)) {
      throw new \RuntimeException("Controller class '$fullClassName' not found");
    }

    return new $fullClassName();
  }

  private function executeMiddleware($middlewareStack, $request, $controller, $method, $parameters)
  {
    if (empty($middlewareStack)) {
      return $controller->$method($parameters);
    }

    $middleware = array_shift($middlewareStack);

    // If middleware is a string, convert it to an instance
    if (is_string($middleware)) {
      $middlewareClass = "Framework\\middleware\\{$middleware}";
      $middleware = new $middlewareClass();
    }

    if (!$middleware instanceof MiddlewareInterface) {
      throw new \RuntimeException("Middleware must implement MiddlewareInterface");
    }

    return $middleware->handle($request, function ($request) use ($middlewareStack, $controller, $method, $parameters) {
      return $this->executeMiddleware($middlewareStack, $request, $controller, $method, $parameters);
    });
  }


  public function route()
  {
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $path = $this->sanitizeUri(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $routeKey = $requestMethod . ' ' . $path;

    if (isset($this->routes[$routeKey])) {
      $route = $this->routes[$routeKey];
      $parameters = [];
    } else {
      $route = null;
      $parameters = [];

      // Tìm route phù hợp với pattern
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

      if (!$route) {
        ErrorController::notFound();
        return;
      }
    }
    // Khởi tạo controller với namespace tương ứng
    $controllerInstance = $this->instantiateController(
      $route['controller'],
      $route['namespace']
    );

    $controllerMethod = $route['controllerMethod'];

    if (!method_exists($controllerInstance, $controllerMethod)) {
      throw new \RuntimeException(
        "Method {$controllerMethod} not found in controller {$route['controller']}"
      );
    }


    return $this->executeMiddleware(
      $route['middleware'],
      $_REQUEST,
      $controllerInstance,
      $controllerMethod,
      $parameters
    );
  }
}
