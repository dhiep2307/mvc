<?php
    define('_DIR_ROOT', str_replace('\\', '/', __DIR__));
    // define('_DIR_ROOT', __DIR__);

// if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    //     $web_root = 'https://' . $_SERVER['HTTP_HOST'];
    // }
    // else {
    //     $web_root = 'http://' . $_SERVER['HTTP_HOST'];
    // }

    $web_root = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'];
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
        $folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), "", strtolower(_DIR_ROOT));
        $web_root = $web_root . $folder;
    }

    define('_WEB_ROOT', $web_root); // tên host
    // load các configs
    $configs_dir = scandir("configs");
    if (!empty($configs_dir)) {
        foreach ($configs_dir as $item) {
            if ($item != '.' && $item != '..' && file_exists('configs/' . $item)) {
                require_once 'configs/' . $item;
            }
        }
    }

    require_once 'app/core/Route.php';
    require_once 'app/core/Session.php';
    require_once 'app/App.php';
    if (!empty($db_config)) {
        require_once 'app/core/Connection.php';
        require_once 'app/core/DB.php';
    }
    require_once 'app/core/Model.php';
    require_once 'app/core/Controller.php';
    require_once 'app/core/Request.php';
    require_once 'app/core/Response.php';
?>