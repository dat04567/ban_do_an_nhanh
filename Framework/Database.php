<?php

namespace Framework;


use PDO;
use PDOException;
use Exception;
use PDOStatement;

class Database
{
   private static ?Database $instance = null;
   private ?PDO $conn;
   private array $settings = [];
   private int $transactionCount = 0;


   private const CACHE_FILE = 'file';    // File-based caching
   private const CACHE_MEM = 'memory';   // In-memory caching

   private string $cacheMethod;
   private array $memoryCache = [];
   private string $cacheDir;
   private $savepoints = [];



   // Configuration using environment variables for security
   private array $default_settings = [
      'driver' => 'mysql',
      'host' => 'localhost',
      'db_name' => '',
      'username' => '',
      'password' => '',
      'charset' => 'utf8mb4',
      'port' => '3306',
      'cache_method' => 'file',  // 'file'  hoặc 'memory'  
      'options' => [
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
         PDO::ATTR_EMULATE_PREPARES => false,
         PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
         PDO::ATTR_PERSISTENT => true // Enable connection pooling
      ]
   ];

   // Private constructor with configuration parameter
   private function __construct(?array $settings = null)
   {

      $this->settings = array_merge(
         $this->default_settings,
         $settings ?? $this->loadEnvSettings()
      );

      $this->connect();

      // sử dụng cache file
      // Initialize cache settings
      $this->cacheMethod = $settings['cache_method'] ?? self::CACHE_FILE;
      $this->cacheDir = $settings['cache_dir'] ?? basePath('cache');


      // Create cache directory if using file cache   
      if ($this->cacheMethod === self::CACHE_FILE) {

         if (!is_dir($this->cacheDir)) {

            if (!mkdir($this->cacheDir, 0777, true)) {
               throw new Exception("Failed to create directory: " . $this->cacheDir);
            }
         }
      }
   }

   // Load settings from environment variables
   private function loadEnvSettings(): array
   {
      return [
         'host' => $_ENV['DB_HOST'] ?: $this->default_settings['host'],
         'db_name' => $_ENV['DB_NAME'] ?: $this->default_settings['db_name'],
         'username' => $_ENV['DB_USER'] ?: $this->default_settings['username'],
         'password' => $_ENV['DB_PASS'] ?: $this->default_settings['password'],
         'port' => $_ENV['DB_PORT'] ?: $this->default_settings['port'],
      ];
   }

   // Establish database connection
   private function connect(): void
   {
      try {
         $dsn = "{$this->settings['driver']}:host={$this->settings['host']};";
         $dsn .= "dbname={$this->settings['db_name']};";
         $dsn .= "charset={$this->settings['charset']};";
         $dsn .= "port={$this->settings['port']}";



         $this->conn = new PDO(
            $dsn,
            $this->settings['username'],
            $this->settings['password'],
            $this->settings['options']
         );
      } catch (PDOException $e) {

         throw new Exception("Connection failed: " . $e->getMessage());
      }
   }

   // Get singleton instance with optional configuration
   public static function getInstance(?array $settings = null): Database
   {
      if (self::$instance === null) {
         self::$instance = new self($settings);
      }
      return self::$instance;
   }

   // Get PDO connection
   public function getConnection(): PDO
   {
      return $this->conn;
   }

   // Enhanced query method with caching capability
   public function query(string $sql, array $params = [], ?int $cacheDuration = null)
   {

      $cacheKey = $this->generateCacheKey($sql, $params);


      if ($cacheDuration !== null && $cachedResult = $this->getCache($cacheKey)) {
         return $cachedResult;
      }

      try {
         $stmt = $this->conn->prepare($sql);
         $this->bindValues($stmt, $params);
         $stmt->execute();




         if ($cacheDuration !== null) {
            // Lấy tất cả kết quả truy vấn dưới dạng mảng
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Đặt lại con trỏ của PDOStatement để có thể sử dụng lại
            $stmt->execute();
            // Lưu trữ kết quả vào cache
            $this->setCache($cacheKey,  [
               'data' => $result,
               'sql' => $sql
            ], $cacheDuration);
         }


         return $stmt;
      } catch (PDOException $e) {
         throw new PDOException($e->getMessage());
      }
   }




   public function beginTransaction(): bool
   {
      if ($this->transactionCount === 0) {
         $this->conn->beginTransaction();
      } else {
         $savepointName = 'trans' . $this->transactionCount;
         $this->conn->exec("SAVEPOINT " . $savepointName);
         $this->savepoints[] = $savepointName;
      }
      $this->transactionCount++;
      return true;
   }

   public function commit(): bool
   {
      $this->transactionCount--;

      if ($this->transactionCount === 0) {
         return $this->conn->commit();
      } else if ($this->transactionCount > 0) {
         $savepointName = array_pop($this->savepoints);
         $this->conn->exec("RELEASE SAVEPOINT " . $savepointName);
      }
      return true;
   }

   public function rollback(): bool
   {
      if ($this->transactionCount === 0) {
         return $this->conn->rollBack();
      }

      $this->transactionCount--;
      if (count($this->savepoints) > 0) {
         $savepointName = array_pop($this->savepoints);
         $this->conn->exec("ROLLBACK TO SAVEPOINT " . $savepointName);
      }
      return true;
   }

   // Smart parameter binding
   private function bindValues(PDOStatement $stmt, array $params): void
   {
      foreach ($params as $key => $value) {
         $type = match (gettype($value)) {
            'boolean' => PDO::PARAM_BOOL,
            'integer' => PDO::PARAM_INT,
            'NULL' => PDO::PARAM_NULL,
            default => PDO::PARAM_STR
         };

         $stmt->bindValue(
            is_string($key) ? $key : $key + 1,
            $value,
            $type
         );
      }
   }

   // Generate cache key
   private function generateCacheKey(string $sql, array $params): string
   {
      return md5($sql . serialize($params));
   }


   /**
    * File-based cache methods
    */
   private function getFileCache(string $key)
   {
      $filename = $this->cacheDir . '/' . md5($key) . '.cache';


      if (!file_exists($filename)) {
         return null;
      }

      $content = file_get_contents($filename);
      $data = unserialize($content);




      if ($data === false || !isset($data['expires']) || !isset($data['value'])) {
         unlink($filename);
         return null;
      }

      if (time() > $data['expires']) {
         unlink($filename);
         return null;
      }

      return $data['value'];
   }


   /**
    * Memory cache methods
    */
   private function getMemoryCache(string $key)
   {
      if (!isset($this->memoryCache[$key])) {
         return null;
      }

      $data = $this->memoryCache[$key];

      if (time() > $data['expires']) {
         unset($this->memoryCache[$key]);
         return null;
      }

      return $data['value'];
   }


   // Get cached result
   private function getCache(string $key)
   {

      switch ($this->cacheMethod) {
         case self::CACHE_FILE:

            return $this->getFileCache($key);


         case self::CACHE_MEM:
            return $this->getMemoryCache($key);

         default:
            return null;
      }
   }

   // Set file-based cache

   private function setFileCache(string $key, $value, int $duration): void
   {

      $filename = $this->cacheDir . '/' . md5($key) . '.cache';



      $data = [
         'expires' => time() + $duration,
         'value' => $value
      ];


      file_put_contents($filename, serialize($data), LOCK_EX);
   }


   // Set memory cache

   private function setMemoryCache(string $key, $value, int $duration): void
   {
      $this->memoryCache[$key] = [
         'expires' => time() + $duration,
         'value' => $value
      ];
   }

   /**
    * Set cache data
    */
   private function setCache(string $key, $value, int $duration): void
   {

      switch ($this->cacheMethod) {
         case self::CACHE_FILE:
            $this->setFileCache($key, $value, $duration);
            break;
         case self::CACHE_MEM:
            $this->setMemoryCache($key, $value, $duration);
            break;
      }
   }

   /**
    * Clear cache
    */
   public function clearCache(): void
   {
      switch ($this->cacheMethod) {
         case self::CACHE_FILE:
            $files = glob($this->cacheDir . '/*.cache');
            foreach ($files as $file) {
               unlink($file);
            }
            break;
         case self::CACHE_MEM:
            $this->memoryCache = [];
            break;
      }
   }

   // Helper method for SELECT queries
   public function select(string $sql, array $params = [], ?int $cacheDuration = null): array
   {

      $stmt = $this->query($sql, $params, $cacheDuration);

      if ($stmt instanceof PDOStatement) {
         return $stmt->fetchAll();
      }
      return $stmt['data'];
   }
   // Helper method for INSERT queries
   public function insert(string $table, array $data): array
   {
      $fields = array_keys($data);
      $values = array_values($data);
      $placeholders = str_repeat('?,', count($fields) - 1) . '?';

      $sql = "INSERT INTO {$table} (" . implode(',', $fields) . ") VALUES ($placeholders)";
      $this->query($sql, $values);






      $this->clearSingleCache($table);

      return [
         'lastInsertId' => $this->conn->lastInsertId()
      ];
   }


   // Helper method for DELETE queries

   public function delete(string $table, string $where, array $params = []): array
   {
      $sql = "UPDATE {$table} SET isDeleted = true WHERE {$where}";
      $stmt = $this->query($sql, $params);


      $this->clearSingleCache($table);

      return [
         'rowCount' => $stmt->rowCount()
      ];
   }

   public function clearSingleCache(string $table): void
   {
      switch ($this->cacheMethod) {
         case self::CACHE_FILE:
            // Read all cache files
            $files = glob($this->cacheDir . '/*.cache');
            foreach ($files as $file) {
               $content = file_get_contents($file);
               $data = unserialize($content)['value'];


               // If cache contains query for this table, delete it
               if (isset($data['sql']) && stripos($data['sql'], $table) !== false) {
                  unlink($file);
               }
            }
            break;

         case self::CACHE_MEM:
            // Scan memory cache for queries containing table name
            // foreach ($this->memoryCache as $key => $data) {
            //    if (isset($data['sql']) && stripos($data['sql'], $table) !== false) {
            //       unset($this->memoryCache[$key]);
            //    }
            // }
            break;
      }
   }


   // Helper method for UPDATE queries
   public function update(string $table, array $data, string $where, array $params = []): array
   {
      $fields = array_keys($data);
      $set = implode('=?,', $fields) . '=?';

      $sql = "UPDATE {$table} SET {$set} WHERE {$where}";
      $stmt = $this->query($sql, [...array_values($data), ...$params]);

      return [
         'rowCount' => $stmt->rowCount()
      ];
   }

   // Prevent cloning
   private function __clone() {}

   // Prevent unserialization
   public function __wakeup()
   {
      throw new Exception("Cannot unserialize singleton");
   }

   // Clean up on destruction
   public function __destruct()
   {
      $this->conn = null;
      self::$instance = null;
   }
}
