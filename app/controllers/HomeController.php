<?php
namespace App\Controllers;

use Core\Database;
use Core\Config;

class HomeController {
    public function __construct() {
        $dbConfig = Config::getInstance()->get('database');
        $db = new Database($dbConfig);
    }
    
    public function index() {        
        // Charger la vue de la page d'accueil
        require_once '../app/views/header.php';
        require_once '../app/views/home.php';  // Créez cette vue si elle n'existe pas
        require_once '../app/views/footer.php';
    }
}

