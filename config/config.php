<?php

// Définition de la constante BASE_URL
if (!defined('BASE_URL')) {
    define('BASE_URL', 'https://test.com/');
}
// Retour de la configuration de la base de données
return [
    'database' => [
        'dsn' => 'sqlite:' . __DIR__ . '/../database/test.db',
    ],
];
