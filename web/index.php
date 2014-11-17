<?php
/**
 * Created by PhpStorm.
 * User: jeffersonsouza
 * Date: 16/11/14
 * Time: 12:28
 */
require_once __DIR__.'/../vendor/autoload.php';
use Movies\Model\Movie;
$app = new Silex\Application();

$app->get('/hello/{name}', function ($name) use ($app) {
    $m = Movie::all();

    return 'Hello '.$app->escape($name);
});

$app->run();