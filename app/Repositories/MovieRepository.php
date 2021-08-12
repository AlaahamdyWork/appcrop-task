<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Http;
use App\Movie;
use App\Category;

class MovieRepository{

    /**
     * get the movies after sorting by required data
     */
    public function getMovies($request)
    {
        $query = Movie::query();
        if ($request->category_id) {
            $category_id = $request->category_id;
            $query = Movie::when($category_id, function ($query) use ($category_id) {
                return $query->whereHas('categories', function ($q) use ($category_id) {
                    $q->where('category_id', $category_id);
                });
            });
        }

        $query = $this->MoviesSort($query, $request);
        $result = $query->get();

        return $result ;

    }

    /**
     * @param $query
     * @param $request
     * @return $query after sorting
     */
    protected function MoviesSort($query, $request)
    {

        $sorts = array_filter(array_map(function ($value) {
            if (strpos($value, '|') !== false)
                return explode('|', $value);
        }, array_keys($request->all())));

        $sorts_variable = [
            'popular' => 'popularity',
            'rated' => 'vote_average',
        ];

        foreach ($sorts as $sort) {
            if ($sorts_variable[$sort[0]] !== null) {
                $query->orderBy($sorts_variable[$sort[0]], $sort[1]);
            }
        }

        return $query;
    }

    /**
     * @param $url
     * @return mixed
     */
    public function apiRequest($url){
        $response = Http::get($url, [
            'api_key' => 'b36f6fd2b08fc308e35ccf9eff191f9d',
            'language' => 'en-US',
        ]);
        return json_decode($response->body());
    }

    /**
     * get categories from themoviedb and store them in database
     */
    public function storeCategories(){
        $results = $this->apiRequest('https://api.themoviedb.org/3/genre/movie/list');

        foreach ($results->genres as $result){
            Category::create([
                'id' => $result->id,
                'name' => $result->name,
            ]);

        }
    }

    /**
     * get popular movies from themoviedb and store them in database
     */
    public function storeMovies(){
        $results = $this->apiRequest('https://api.themoviedb.org/3/movie/popular');

        foreach ($results->results as $result){
            $movie = Movie::create([
                'id' => $result->id,
                'title' => $result->title,
                'overview' => $result->overview,
                'release_date' => $result->release_date,
                'popularity' => $result->popularity,
                'vote_average' => $result->vote_average,
            ]);

            $movie->categories()->sync($result->genre_ids);
            $movie->save();

        }

    }
}
