<?php

namespace App\Models;


// Base Model Class
abstract class BaseModel {
   protected $attributes = [];
   protected $errors = [];
   protected $rules = [];
   
   public function __construct(array $attributes = []) {
       $this->fill($attributes);
   }
   
   // Fill model with attributes
   public function fill(array $attributes) {
       foreach ($attributes as $key => $value) {
           if (property_exists($this, $key)) {
               $this->$key = $value;
               $this->attributes[$key] = $value;
           }
       }
   }
   
   // Get all attributes
   public function getAttributes() {
       return $this->attributes;
   }
   
   // Get validation errors
   public function getErrors() {
       return $this->errors;
   }
   
   // Validate model
   public function validate(): bool {
       $this->errors = [];
       
       foreach ($this->rules as $field => $rules) {
           foreach ($rules as $rule) {
               $ruleName = $rule;
               $ruleParams = [];
               
               // Handle rules with parameters
               if (is_array($rule)) {
                   $ruleName = $rule[0];
                   $ruleParams = array_slice($rule, 1);
               }
               
               $methodName = 'validate' . ucfirst($ruleName);
               if (method_exists($this, $methodName)) {
                   $value = $this->attributes[$field] ?? null;
                   if (!$this->$methodName($field, $value, ...$ruleParams)) {
                       if (!isset($this->errors[$field])) {
                           $this->errors[$field] = [];
                       }
                       $this->errors[$field][] = $this->getErrorMessage($field, $ruleName, $ruleParams);
                   }
               }
           }
       }
       
       return empty($this->errors);
   }
   
   // Common validation methods
   protected function validateRequired($field, $value): bool {
       return !empty($value);
   }
   
   protected function validateEmail($field, $value): bool {
       return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
   }
   
   protected function validateMin($field, $value, $min): bool {
       return strlen($value) >= $min;
   }
   
   protected function validateMax($field, $value, $max): bool {
       return strlen($value) <= $max;
   }
   
   protected function validateRegex($field, $value, $pattern): bool {
       return preg_match($pattern, $value) === 1;
   }
   
   // Get error message
   protected function getErrorMessage($field, $rule, $params = []): string {
       $messages = $this->getErrorMessages();
       $key = $field . '.' . $rule;
       
       if (isset($messages[$key])) {
           return vsprintf($messages[$key], $params);
       }
       
       return ucfirst($field) . ' validation failed for rule: ' . $rule;
   }
   
   // Override this in child classes to define custom error messages
   protected function getErrorMessages(): array {
       return [];
   }
}