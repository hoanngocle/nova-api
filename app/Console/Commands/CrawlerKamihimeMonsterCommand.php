<?php

namespace App\Console\Commands;

use App\Crawler\KamihimeGirlEngVer;
use App\Crawler\KamihimeMonsterEngVer;
use App\Crawler\KamihimeSoulEngVer;
use Illuminate\Console\Command;

class CrawlerKamihimeMonsterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kamihime:monster {--type=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawler data from harem-club to my database';

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
     * @return int
     */
    public function handle()
    {
        $type = $this->option('type');
        $url = KAMIHIME_FANDOM_WIKI_URL . KAMIHIME_MONSTER;
        $crawler = new KamihimeMonsterEngVer($url, $type);
        $crawler->scrape();
        return true;
    }
}
