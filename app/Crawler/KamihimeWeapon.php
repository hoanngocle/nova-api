<?php

namespace App\Crawler;

use Goutte\Client;
use Illuminate\Support\Str;
use Revolution\Google\Sheets\Facades\Sheets;
use Symfony\Component\DomCrawler\Crawler;

class KamihimeWeapon
{
    protected $url;

    protected $type;

    /**
     * Create a new command instance.
     *
     * @param $url
     * @param $type
     */
    public function __construct($url, $type)
    {
        $this->url = $url;
        $this->type = $type;
    }

    public function scrape()
    {
        $client = new Client();
        $crawler = $client->request('GET', $this->url);
        $listEquipInformation = [];
        $i = 1;
        $crawler->filter('div#tabber-fecb770e001bdb6c43248d7a1954ec3c > div.tabbertab[title="' . $this->type . ' "] > table > tbody > tr')->each(
            function (Crawler $node) use (&$listEquipInformation, &$i) {
                if ($node->filter('td:nth-child(1)')->count() > 0) {
                    $name = $node->filter('td:nth-child(1) a')->text();
                    $href = $node->filter('td:nth-child(1) a')->attr('href');
                    $imgSrc = $node->filter('td:nth-child(2) a img')->attr('data-src');
                    $imgName = $node->filter('td:nth-child(2) a img')->attr('alt');

                    $rarity = $this->type;
                    switch ($rarity) {
                        case 'SSR':
                            $effect = 5;
                            break;
                        case 'SR':
                            $effect = 3;
                            break;
                        case 'R':
                            $effect = 2;
                            break;
                        default:
                            $effect = 1;
                            break;
                    }
                    $minAtk = $node->filter('td:nth-child(11)')->text();
                    if ($i < 300) {
                        $detailImage = $this->crawInfo($href);
                        echo $i;
                    } else {
                        $detailImage = '';
                    }

                    $detailImage = $this->crawInfo($href);

                    $equipmentInfo = [
                        'name' => $name,
                        'img_url' => $href,
                        'image' => $imgSrc,
                        'image_name' => $imgName,
                        'rarity' => $rarity,
                        'effect' => $effect,
                        'min_atk' => $minAtk,
                        'img_src' => $detailImage
                    ];

                    array_push($listEquipInformation, $equipmentInfo);
                }
                $i++;
            }
        );

        $this->uploadToSpreadsheet($listEquipInformation, config('sheets.weapon_sheet_id'));

        return true;
    }

    /**
     * Craw more data information
     *
     * @param $url
     * @return string
     */
    private function crawInfo($url)
    {
        $name = Str::substr($url, 6);
        $name = Str::of($name)->replace('%', '-');

        if (Str::contains($name, ['(', ')'])) {
            return '';
        }
        $url = KAMIHIME_FANDOM_WIKI_URL . $url;
        $imgSrc = '';
        $client = new Client();
        $crawler = $client->request('GET', $url);

        if ($crawler->filter("#" . $name ."-png > a > img")->count() > 0) {
            $imgSrc = $crawler->filter("#" . $name ."-png > a > img")->attr('data-src');
        }

        return $imgSrc;
    }

    private function uploadToSpreadsheet($data, $sheetId)
    {
        $result = Sheets::spreadsheet(config('sheets.ttcl_api_data_spreadsheet_id'))
            ->sheetById($sheetId)
            ->range('B2:M1000')
            ->append($data);

        return $result;
    }
}
