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
$app['debug'] = true;

// Get a Collection of movies
$app->get('/movies', function () use ($app) {
    return new \Symfony\Component\HttpFoundation\Response(Movie::find(1)->toJson(), 200, ['Content-Type' => 'application/json']);
});

// Get a single movie
$app->get('/movies/{movie}', function ($movie) use ($app) {
    if(!empty($movie)){
        $movie = Movie::find($movie);
        if($movie)
            return new Response(json_encode($movie), 200, ['Content-Type' => 'application/json']);

        return new Response(json_encode(['O ID informado não existe']), 404, ['Content-Type' => 'application/json']);
    }

    return new Response(Movie::all()->toJson(), 200, ['Content-Type' => 'application/json']);
});

$app->run();