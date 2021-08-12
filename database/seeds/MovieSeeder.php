<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\Category;
use App\Repositories\MovieRepository;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $movieRepository ;

    public function run(MovieRepository $movieRepository)
    {

        $this->movieRepository = $movieRepository;
        $this->movieRepository->storeCategories();
        $this->movieRepository->storeMovies();


    }
}
