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
use Symfony\Component\HttpFoundation\Response;
use Movies\Models\Movie;

class MoviesControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        // Get a Collection of movies
        $controllers->get('/', function () use ($app) {
            $movies = Movie::paginate(10);

            return new Response($movies->toJson(), 200, ['Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*']);
        });

        // Get top rated movies
        $controllers->get('/tops', function () use ($app) {
            $movies = Movie::where('id', '>', 0)->orderBy('rating', 'DESC')->take(10)->get();

            return new Response($movies->toJson(), 200, ['Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*']);
        });

        // Get a single movie
        $controllers->get('/{movie}', function ($movie) use ($app) {
            if(!empty($movie)){
                $movie = Movie::find($movie);
                if($movie)
                    return new Response($movie->toJson(), 200, ['Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*']);

                return new Response(json_encode(['O ID informado não existe']), 404, ['Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*']);
            }

            return new Response(Movie::paginate(10)->toJson(), 200, ['Content-Type' => 'application/json', 'Access-Control-Allow-Origin' => '*']);
        });

        return $controllers;
    }
}