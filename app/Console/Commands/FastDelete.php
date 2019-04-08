<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use App\Image;

class FastDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:product {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete post bz id fast from console';

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
        $product = Product::find($this->argument('id'));
        $image = new Image;
        $image->paths = json_encode($product->images);
        $image->save();
        $product->delete();

        $this->info('Izbrisano');    }
}
