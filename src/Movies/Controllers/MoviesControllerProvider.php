<?php
/**
 * Created by PhpStorm.
 * User: jeffersonsouza
 * Date: 20/11/14
 * Time: 23:14
 */

namespace Movies\Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Movies\Models\Movie;

class MoviesControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        // Get a Collection of movies
        $controllers->get('/', function () use ($app) {
            return new \Symfony\Component\HttpFoundation\Response(Movie::find(1)->toJson(), 200, ['Content-Type' => 'application/json']);
        });

        // Get a single movie
        $controllers->get('/{movie}', function ($movie) use ($app) {
            if(!empty($movie)){
                $movie = Movie::find($movie);
                if($movie)
                    return new Response(json_encode($movie), 200, ['Content-Type' => 'application/json']);

                return new Response(json_encode(['O ID informado não existe']), 404, ['Content-Type' => 'application/json']);
            }

            return new Response(Movie::all()->toJson(), 200, ['Content-Type' => 'application/json']);
        });

        return $controllers;
    }
}