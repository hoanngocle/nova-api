<?php

namespace App\Crawler;

use Goutte\Client;
use Revolution\Google\Sheets\Facades\Sheets;
use Symfony\Component\DomCrawler\Crawler;

class KamihimeSoulEngVer
{
    protected $url;

    /**
     * Create a new command instance.
     *
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    public function scrape()
    {
        $client = new Client();
        $crawler = $client->request('GET', $this->url);
        $listGirlInformation = [];

        $crawler->filter('div#tabber-c34115969d252575d2fadee30e04a69d > div.tabbertab[title="All "] > table > tbody > tr')->each(
            function (Crawler $node) use (&$listGirlInformation) {
                if ($node->filter('td:nth-child(1) a')->count() > 0) {
                    $href = $node->filter('td:nth-child(1) a')->attr('href');
                    $name = $node->filter('td:nth-child(1) a')->text();

                    $additionalInfo = $this->crawInfo($href, $name);

                    $imgSrc = $node->filter('td:nth-child(2) a img')->attr('data-src');
                    $imgName = $node->filter('td:nth-child(2) a img')->attr('alt');
                    $type = $node->filter('td:nth-child(3) a img')->attr('alt');
                    $releaseCost = $node->filter('td:nth-child(6)')->text();

                    $girlInfo = [
                        'name' => $name,
                        'url' => $href,
                        'type' => $type,
                        'release_cost' => $releaseCost,
                        'portrait' => $imgSrc,
                        'portrait_name' => $imgName,
                        'image_base' => $additionalInfo['image'][0] ?? '',
                        'image_sub' => $additionalInfo['image'][1] ?? '',
                        'tier' => $additionalInfo['tier'],
                        'master_bonus' => $additionalInfo['master_bonus'],
                        'bonus_stat' => $additionalInfo['bonus_stat']
                    ];

                    array_push($listGirlInformation, $girlInfo);
                }
            }
        );

        $this->uploadToSpreadsheet($listGirlInformation, config('sheets.soul_sheet_id'));

        return true;
    }

    /**
     * Craw more data information
     *
     * @param $url
     * @return array
     */
    private function crawInfo($url)
    {
        $listImgUrl = [];
        $tier = '';
        $masterBonus = '';

        $url = KAMIHIME_FANDOM_WIKI_URL . $url;

        $client = new Client();
        $crawler = $client->request('GET', $url);

        $crawler->filter('div.gallery-image-wrapper a')->each(
            function (Crawler $node) use (&$listImgUrl) {
                if ($node->filter('img')->count() > 0) {
                    $imgSrc = $node->filter('img')->attr('src');
                    array_push($listImgUrl, $imgSrc);
                }
            }
        );

        if ($crawler->filter('div#mw-content-text > div > table:nth-child(1)')->count() > 0) {
            $tier = $crawler->filter('#mw-content-text > div > table:nth-child(1) > tbody > tr:nth-child(3) > td:nth-child(3)')->text();
            $masterBonus = $crawler->filter('#mw-content-text > div > table:nth-child(1) > tbody > tr:nth-child(6) > td')->text();
        }

        if ($crawler->filter('#mw-content-text > div > table.BandedRows > tbody')->count() > 0) {
            $bonusStat = $crawler->filter('#mw-content-text > div > table.BandedRows > tbody > tr:nth-child(2) > td:nth-child(2)')->text();
        } else {
            $bonusStat = $crawler->filter('#mw-content-text > div > table.mw-datatable > tbody > tr:nth-child(2) > td:nth-child(2)')->text();
        }

        return [
            'image' => $listImgUrl,
            'tier' => $tier,
            'master_bonus' => $masterBonus,
            'bonus_stat' => $bonusStat,
        ];
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
