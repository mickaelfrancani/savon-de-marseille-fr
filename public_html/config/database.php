<?php
/**
 * Connexion PDO - savon-de-marseille.fr
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'savonmarseille_savondb');
define('DB_USER', 'savonmarseille_savondb');
define('DB_PASS', 'ap4jRrQKA7oMVnJao7Bc');
define('DB_CHARSET', 'utf8mb4');

function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log('DB Connection failed: ' . $e->getMessage());
            http_response_code(500);
            die('Erreur de connexion a la base de donnees.');
        }
    }
    return $pdo;
}
