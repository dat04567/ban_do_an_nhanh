<?php

namespace Framework;

class SessionManager
{
   private static $instance = null;
   private $sessionId;
   private $sessionData = [];

   private function __construct()
   {
      if (session_status() == PHP_SESSION_NONE) {
         session_start();
      }
      $this->sessionId = session_id();
   }

   public static function getInstance()
   {
      if (self::$instance == null) {
         self::$instance = new SessionManager();
      }
      return self::$instance;
   }

   public function set($key, $value)
   {
      $_SESSION[$key] = $value;
      $this->sessionData[$key] = $value;
   }

   public function get($key)
   {
      if (array_key_exists($key, $this->sessionData)) {
         return $this->sessionData[$key];
      } else {
         if (isset($_SESSION[$key])) {
            $this->sessionData[$key] = $_SESSION[$key];
            return $this->sessionData[$key];
         } else {
            return null;
         }
      }
   }

   public function has($key)
   {
      return isset($_SESSION[$key]) || array_key_exists($key, $this->sessionData);
   }


   public function remove($key)
   {
      unset($_SESSION[$key]);
      unset($this->sessionData[$key]);
   }



   public function destroy()
   {
      session_destroy();
      $this->sessionData = [];
   }

   public function regenerate()
   {
      session_regenerate_id(true);
      $this->sessionId = session_id();
   }

   public function getId()
   {
      return $this->sessionId;
   }
}
