<?php
session_start();

require_once 'autoload.php';

require_once 'config/database.php';
require_once 'config/parameters.php';
require_once 'helpers/helpers.php';

require_once 'views/partials/header.php';
require_once 'views/partials/sidebar.php';

function show_errors(){
    $error = new ErrorsController();
    $error->index();
}

if(isset($_GET['controller'])){

    $name_controller = $_GET['controller'] . 'Controller';

}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $name_controller = controller_default;
}
else{
    show_errors();
    
    exit();
}

if(class_exists($name_controller)){

    $controller = new $name_controller();

    
    if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
        $action = $_GET['action'];
        $controller->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $action_default = action_default;
        $controller->$action_default();
    }else {
        show_errors();
    }

}else{
    show_errors();
}

// http://php.test/php-mvc-project/?controller=Users&action=index

require_once 'views/partials/footer.php';

?>