<?php

namespace App\Jobs;

use App\Repositories\MovieRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateMovies implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $movie;
    public $movieRepository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($movie , MovieRepository $movieRepository)
    {
        //
        $this->movie = $movie;
        $this->movieRepository = $movieRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->movieRepository->createMovie($this->movie);
    }
}
