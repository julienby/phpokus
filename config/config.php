<?php

// Définition de la constante BASE_URL
if (!defined('BASE_URL')) {
    define('BASE_URL', 'https://seinebnb.com/');
}
// Retour de la configuration de la base de données
return [
    'database' => [
        'dsn' => 'sqlite:' . __DIR__ . '/../database/seinebnb.db',
    ],
];
