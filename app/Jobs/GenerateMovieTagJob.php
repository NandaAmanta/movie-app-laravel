<?php

namespace App\Jobs;

use App\Mail\WellcomeMail;
use App\Repositories\MovieTagRepository;
use App\Repositories\TagRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GenerateMovieTagJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private MovieTagRepository $movieTagRepo;
    private TagRepository $tagRepo;
    private string $name;
    private int $movieId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MovieTagRepository $movieTagRepo, TagRepository $tagRepository, string $name, int $movieId)
    {
        $this->movieTagRepo = $movieTagRepo;
        $this->tagRepo = $tagRepository;
        $this->name = $name;
        $this->movieId = $movieId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tag = $this->tagRepo->save([
            "name" => $this->name
        ]);

        $this->movieTagRepo->save([
            "tag_id"=> $tag->id,
            "movie_id"=> $this->movieId,
        ]);

    }
}
