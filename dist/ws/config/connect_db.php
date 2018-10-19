<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$config['db']['host']   = "203.158.167.20";
$config['db']['user']   = "admin_portal";
$config['db']['pass']   = "Hg5N6NF0oT";
$config['db']['dbname'] = "admin_portal";

$app = new \Slim\App(["settings" => $config, 'displayErrorDetails' => true]);

// CorsSlim for Cross domain request
$corsOptions = array(
    "origin" => "*",
    "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client"),
    "allowMethods" => array("GET", "POST", "PUT", "DELETE", "OPTIONS")
    );
$cors = new \CorsSlim\CorsSlim($corsOptions);

$app->add($cors);

// Get Container
$container = $app->getContainer();

// PDO database library
$container['db'] = function ($c) {
    $db = $c->get('settings')['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'] . "; port=3306; charset=utf8",
        $db['user'], $db['pass']);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

?>