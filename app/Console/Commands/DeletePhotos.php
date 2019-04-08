<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Image;


class DeletePhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:photos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all inactive photos daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Image::all() as $image) {
            $area = json_decode($image->paths, true);
            foreach($area as $path)
            {
                $image=str_replace("storage/", "", $path);
                Storage::disk('public')->delete($image);
                Storage::disk('public')->delete(smallImage($image));
            }
        }
        Image::truncate();
    }
}
