<?php
/**
 * Created by PhpStorm.
 * User: jeffersonsouza
 * Date: 16/11/14
 * Time: 23:14
 */
require __DIR__ . '/../../vendor/autoload.php';

use \Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection(array(

    'driver'   => 'sqlite',
    'database' => __DIR__.'/../../web/movies.db',
    'prefix'   => '',

));

$capsule->bootEloquent();