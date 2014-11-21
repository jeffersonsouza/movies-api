<?php
/**
 * Created by PhpStorm.
 * User: jeffersonsouza
 * Date: 16/11/14
 * Time: 12:28
 */
require_once __DIR__.'/../vendor/autoload.php';
$app = new Silex\Application();
$app['debug'] = true;

$app->mount('/movies', new Movies\Controllers\MoviesControllerProvider());

$app->run();