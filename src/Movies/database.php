<?php
/**
 * Created by PhpStorm.
 * User: jeffersonsouza
 * Date: 16/11/14
 * Time: 23:14
 */
require '../../vendor/autoload.php';

use \Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection(array(
    'sqlite' => array(
        'driver'   => 'sqlite',
        'database' => __DIR__.'/../database/production.sqlite',
        'prefix'   => '',
    ),
));

$capsule->bootEloquent();