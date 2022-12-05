<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Document</title>
</head>
<body>

<?php

// on definie le chemin vers l'index

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));


require_once ROOT.'app/'.'Controller.php';
require_once ROOT.'app/'.'Model.php';

// on sépare les paramètres de l'url

$params = explode('/', $_GET['p']);

// est ce qu'un paramètre existe

$params[0] = !empty($params[0]) ? $params[0] : 'user';


$controller = ucfirst($params[0]);

$action = isset($params[1]) ? $params['1'] : 'login';


require_once(ROOT.'controllers/'.$controller.'.php');

$controller = new $controller();

if(method_exists($controller, $action)) {
    $controller->$action();
}
else {
    http_response_code(404);
    echo "La page demandée n'existe pas";
}

?>

</body>
</html>