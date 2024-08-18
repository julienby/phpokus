<?php

require_once '../vendor/autoload.php';
require_once '../core/Config.php';
require_once '../core/Router.php';
require_once '../core/Database.php';
require_once '../app/models/BaseModel.php';
require_once '../app/models/UserModel.php';


// Démarre le routeur
$router = new Core\Router();
$router->run();

