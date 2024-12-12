<?php


namespace App\middleware;

use Framework\MiddlewareInterface;
use Framework\SessionManager;

class AuthMiddleware implements MiddlewareInterface
{
   public function handle($request, $next)
   {
      // Check if user is authenticated
      if (!SessionManager::getInstance()->has('user')) {
         header('Location: /sign-in');
      
         
         exit;
      }
      return $next($request);
   }
}

