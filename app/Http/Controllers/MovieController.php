<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Repositories\MovieRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    //

    protected $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;

    }


    public function getMovies(Request $request)
    {
        $result = $this->movieRepository->getMovies($request);

        return response(['movies' => $result], 200);

    }

}
