<?php
namespace App\Controllers;

//use App\Models\PageModel; (à crééer)
use Core\Database;
use Core\Config;

class PageController {
 
    private $userModel;
            
    public function __construct() {
        $dbConfig = Config::getInstance()->get('database');
    }


    public function index() {
        require_once '../app/views/header.php';
        require_once '../app/views/page1.php';
        require_once '../app/views/footer.php';
    }

    public function page2() {
        require_once '../app/views/header.php';
        require_once '../app/views/page2.php';
        require_once '../app/views/footer.php';
    }
    
    public function about() {
        require_once '../app/views/header.php';
        require_once '../app/views/about.php';
        require_once '../app/views/footer.php';
    }
    
    public function view($id) {
        require_once '../app/views/header.php';
        require_once '../app/views/page'.$id.'.php';
        require_once '../app/views/footer.php';
    }
}

