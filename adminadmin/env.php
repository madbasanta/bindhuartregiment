<?php
$envFile = dirname(__DIR__) . '/' . '.env';

function loadEnv($envFilePath = '.env') {
    if (file_exists($envFilePath)) {
        $lines = file($envFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines !== false) {
            foreach ($lines as $line) {
                // Split each line into a key and value based on the '=' character
                list($key, $value) = explode('=', $line, 2);

                // Trim whitespace and quotes from the key and value
                $key = trim($key);
                $value = trim($value, " \t\n\r\0\x0B\"'");

                // Set the environment variable
                if (!empty($key) && !empty($value)) {
                    putenv("$key=$value");
                }
            }
        } else {
            throw new Exception("Unable to read the $envFilePath file.");
        }
    } else {
        throw new Exception("The $envFilePath file does not exist.");
    }
}

loadEnv($envFile);