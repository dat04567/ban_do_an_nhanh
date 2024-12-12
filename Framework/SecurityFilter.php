<?php
namespace Framework;


class SecurityFilter {
    // Configurable security levels
    private const SECURITY_LEVELS = [
        'low' => [
            'strip_tags' => true,
            'htmlspecialchars' => true,
            'trim' => true,
        ],
        'medium' => [
            'strip_tags' => true,
            'htmlspecialchars' => true,
            'trim' => true,
            'validate_regex' => true,
        ],
        'high' => [
            'strip_tags' => true,
            'htmlspecialchars' => true,
            'trim' => true,
            'validate_regex' => true,
            'advanced_filtering' => true,
        ]
    ];

    // Predefined regex patterns
    private const PATTERNS = [
        'username' => '/^[a-zA-Z0-9_]{3,20}$/u',
        'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/u',
        'alphanumeric' => '/^[a-zA-Z0-9\s\p{L}]+$/u', // Added \p{L} for all UTF-8 letters including Vietnamese
    ];

    /**
     * Sanitize and validate input
     * 
     * @param mixed $input Input to be cleaned
     * @param string $type Input type (optional)
     * @param string $securityLevel Security level
     * @return mixed Sanitized input
     */
    public static function clean(
        $input, 
        string $type = 'default', 
        string $securityLevel = 'medium'
    ): mixed {
        // Null or empty input handling
        if ($input === null || $input === '') {
            return $input;
        }

        // Handle arrays recursively
        if (is_array($input)) {
            return array_map(fn($item) => self::clean($item, $type, $securityLevel), $input);
        }

        // Convert to string with UTF-8 encoding
        $input = (string) $input;
        if (!mb_check_encoding($input, 'UTF-8')) {
            $input = mb_convert_encoding($input, 'UTF-8', 'auto');
        }

        $config = self::SECURITY_LEVELS[$securityLevel] ?? self::SECURITY_LEVELS['medium'];

        // Basic sanitization steps
        if ($config['trim']) {
            $input = trim($input);
        }

        if ($config['strip_tags']) {
            $input = strip_tags($input);
        }

        if ($config['htmlspecialchars']) {
            $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }

        // Advanced filtering based on type
        if ($config['validate_regex']) {
            $input = self::validateByType($input, $type);
        }

        // Additional advanced filtering
        if ($config['advanced_filtering'] ?? false) {
            $input = self::advancedFiltering($input);
        }

        return $input;
    }

    /**
     * Validate input based on predefined types
     * 
     * @param string $input Input to validate
     * @param string $type Input type
     * @return string Validated input
     */
    private static function validateByType(string $input, string $type): string {
        // Check if a predefined pattern exists
        $pattern = self::PATTERNS[$type] ?? self::PATTERNS['alphanumeric'];
        
        // If input doesn't match pattern, return empty string
        return preg_match($pattern, $input) ? $input : '';
    }

    /**
     * Advanced filtering for high-security scenarios
     * 
     * @param string $input Input to filter
     * @return string Filtered input
     */
    private static function advancedFiltering(string $input): string {
        // Remove potential XSS vectors while preserving Vietnamese characters
        $input = preg_replace([
            '/<script\b[^>]*>(.*?)<\/script>/isu',
            '/on\w+="[^"]*"/iu',
            '/javascript:/iu',
            '/vbscript:/iu',
            '/onerror=/iu'
        ], '', $input);

        // Remove control characters but preserve Vietnamese
        $input = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $input);

        return $input;
    }

    /**
     * Validate and sanitize JSON input
     * 
     * @param string $json JSON string to validate
     * @return mixed Validated JSON or null
        */
        public static function cleanJson(string $json): mixed {
            // Validate JSON
            $decoded = json_decode($json, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return null;
            }

            // Recursively clean JSON data
            return self::clean($decoded);
        }

    /**
     * Generate a cryptographically secure random token
     * 
     * @param int $length Token length
     * @return string Random token
     */
    public static function generateToken(int $length = 32): string {
        return bin2hex(random_bytes($length / 2));
    }
}

