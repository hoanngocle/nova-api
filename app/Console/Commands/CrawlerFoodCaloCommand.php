<?php

namespace App\Console\Commands;

use App\Crawler\FoodCalo;
use App\Crawler\KamihimeGirl;
use Illuminate\Console\Command;

class CrawlerFoodCaloCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'food:calo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $crawler = new FoodCalo();
        $crawler->scrape();
        return 0;
    }
}
