<?php

include '../product.php';
include '../menu.php';
include 'curlApi.php';
include '../bootstrap.php';
echo "<link rel='stylesheet' type='text/css' href='/css/app.css'>";
echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'>";
echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>";
echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$authData = json_decode(file_get_contents("php://input"), true);
$accessToken = authenticate($authData);

if (!$accessToken) {
    die("Authorization failed!");
} else {
    if (in_array('product', $uri)) {
        $params = array_combine(['domain', 'menu', 'menu_id', 'products', 'product_id'], $uri);
        updateProduct($params["menu_id"], $params["product_id"], $base_url, $accessToken);

    } else if (in_array('products', $uri)) {
        $params = array_combine(['domain', 'menu', 'menu_id', 'products'], $uri);
        getProduct($params["menu_id"], $base_url, $accessToken, $template);

    } else if (in_array('menus', $uri)) {
        getMenu($base_url, $accessToken, $template);
    }
}

?>
