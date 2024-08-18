<?php

namespace App\Controllers;

use App\Models\UserModel;
use Core\Database;
use Core\Config;

class UserController {
    private $userModel;

    public function __construct() {
        $dbConfig = Config::getInstance()->get('database');
        $db = new Database($dbConfig);
        $this->userModel = new UserModel($db);
    }

    public function create($id) {
        $this->userModel->insertUser('John Doe'.$id, 'john'.$id.'@example.com');
        echo "User ".$id."created!";
    }

    public function index() {
        //$users = $this->userModel->getUsers();
        $users = $this->userModel->findAll();
        require_once '../app/views/header.php';
        require_once '../app/views/users.php';
        require_once '../app/views/footer.php';
    }
    
    public function show($id) {
        //$users = $this->userModel->getUsers();
        $user = $this->userModel->findById($id);
        require_once '../app/views/header.php';
        require_once '../app/views/user.php';
        require_once '../app/views/footer.php';
    }
}

