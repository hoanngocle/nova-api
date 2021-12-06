<?php

namespace App\Crawler;

use Goutte\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Revolution\Google\Sheets\Facades\Sheets;
use Symfony\Component\DomCrawler\Crawler;

class KamihimeGirl
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

        $this->url = 'http://localhost:8099/kamihime/kamihime-girl-2.html';
        $crawler = $client->request('GET', $this->url);
        $listGirlInformation = [];
        $listSkill = [];
        $listImage = [];
        $id = 301;
//        $maxRound = 1;

        $crawler->filter('tbody tr')->each(
            function (Crawler $node) use (&$listGirlInformation, &$listSkill, &$listImage, &$id) {
                if ($node->filter('td:nth-child(1) a')->count() > 0) {
                    $href = $node->filter('td:nth-child(1) a')->attr('href');
                    $name = $node->filter('td:nth-child(1) a')->text();
                    $additionalInfo = $this->crawInfo($href, $name, $id);
//                    $imgSrc = $node->filter('td:nth-child(2) a img')->attr('data-src');
//                    $imgName = $node->filter('td:nth-child(2) a img')->attr('alt');
//
//                    $rarity = $node->filter('td:nth-child(3) a img')->attr('alt');
//                    $element = $node->filter('td:nth-child(4) a img')->attr('alt');
//                    $type = $node->filter('td:nth-child(5) a img')->attr('alt');
//
//                    $minAtk = $node->filter('td:nth-child(6)')->text();
//                    $maxAtk = $node->filter('td:nth-child(7)')->text();
//                    $minHP = $node->filter('td:nth-child(8)')->text();
//                    $maxHP = $node->filter('td:nth-child(9)')->text();
//                    $minPW = $node->filter('td:nth-child(10)')->text();
//                    $maxPW = $node->filter('td:nth-child(11)')->text();
//                    $girlInfo = [
//                        'id' => $id,
//                        'name' => $name,
//                        'description' => $additionalInfo['description'],
//                        'url' => $href,
//                        'portrait' => $imgSrc,
//                        'portrait_name' => $imgName,
//                        'rarity' => $rarity,
//                        'element' => $element,
//                        'type' => $type,
//                        'min_atk' => $minAtk,
//                        'max_atk' => $maxAtk,
//                        'min_hp' => $minHP,
//                        'max_hp' => $maxHP,
//                        'min_pw' => $minPW,
//                        'max_pw' => $maxPW,
//                    ];

//                    array_push($listGirlInformation, $girlInfo);
                    array_push($listSkill, $additionalInfo['skill']);
//                    array_push($listImage, $additionalInfo['image']);
                    $id++;
                }
            }
        );

//        $this->uploadToSpreadsheet($listGirlInformation, config('sheets.girl_sheet_id'));
//        $this->uploadToSpreadsheet(Arr::collapse($listImage), config('sheets.girl_image_sheet_id'));
        $this->uploadToSpreadsheet(Arr::collapse($listSkill), config('sheets.girl_skill_sheet_id'));

        return true;
    }

    /**
     * Craw more data information
     *
     * @param $url
     * @param $girlName
     * @return array
     */
    private function crawInfo($url, $girlName, $id): array
    {
        $listImgUrl = [];
        $girlSkill = [];
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $crawler->filter('.wikia-gallery-item')->each(
            function (Crawler $node) use (&$listImgUrl, &$id) {
                if ($node->filter('img')->count() > 0) {
                    $imgSrc = [
                        'girl_id' => $id,
                        'url' => $node->filter('img')->attr('src'),
                        'name' => $node->filter('img')->attr('data-image-name'),
                        'type' => $node->filter('img')->attr('data-caption'),
                    ];
                    array_push($listImgUrl, $imgSrc);
                }
            }
        );

        $crawler->filter('div#mw-content-text > div > table:nth-child(4)')->each(
            function (Crawler $node) use (&$girlSkill, &$girlName, &$id) {
                $burst = [];
                $skill_1 = [];
                $skill_2 = [];
                $skill_3 = [];
                $passive = [];

                if ($node->filter('tr:nth-child(2) > td > a > img')->count() > 0) {
                    $burst = [
                        'girl_id' => $id,
                        'girl_name' => $girlName,
                        'type' => 'burst',
                        'icon' => $node->filter('tr:nth-child(2) > td > a > img')->attr('data-src'),
                        'name' => $node->filter('tr:nth-child(2) > td > b')->text(),
                        'description' => $node->filter('tr:nth-child(3)')->text(),
                    ];
                }

                if ($node->filter('tr:nth-child(4) > td > a > img')->count() > 0) {
                    $skill_1 = [
                        'girl_id' => $id,
                        'girl_name' => $girlName,
                        'type' => 'skill_1',
                        'icon' => $node->filter('tr:nth-child(4) > td > a > img')->attr('data-src'),
                        'name' => $node->filter('tr:nth-child(4) > td > b')->text(),
                        'description' => $node->filter('tr:nth-child(5)')->text(),
                    ];
                }

                if ($node->filter('tr:nth-child(6) > td > a > img')->count() > 0) {
                    $skill_2 = [
                        'girl_id' => $id,
                        'girl_name' => $girlName,
                        'type' => 'skill_2',
                        'icon' => $node->filter('tr:nth-child(6) > td > a > img')->attr('data-src'),
                        'name' => $node->filter('tr:nth-child(6) > td > b')->text(),
                        'description' => $node->filter('tr:nth-child(7)')->text(),
                    ];
                }

                if ($node->filter('tr:nth-child(8) > td > a > img')->count() > 0) {
                    $skill_3 = [
                        'girl_id' => $id,
                        'girl_name' => $girlName,
                        'type' => 'skill_3',
                        'icon' => $node->filter('tr:nth-child(8) > td > a > img')->attr('data-src'),
                        'name' => $node->filter('tr:nth-child(8) > td > b')->text(),
                        'description' => $node->filter('tr:nth-child(9)')->text(),
                    ];
                }

                if ($node->filter('tr:nth-child(10) > td > a > img')->count() > 0) {
                    $passive = [
                        'girl_id' => $id,
                        'girl_name' => $girlName,
                        'type' => 'passive',
                        'icon' => $node->filter('tr:nth-child(10) > td > a > img')->attr('data-src'),
                        'name' => $node->filter('tr:nth-child(10) > td > b')->text(),
                        'description' => $node->filter('tr:nth-child(11)')->text(),
                    ];
                }

                $girlSkill = [$burst, $skill_1, $skill_2, $skill_3, $passive];
            }
        );

        return [
            'image' => $listImgUrl,
            'skill' => $girlSkill,
            'description' => $crawler->filter('div#mw-content-text > div.mw-parser-output > table.infobox > tbody > tr:nth-child(2) td')->text()
        ];
    }

    /**
     * @param $data
     * @param $sheetId
     * @return mixed
     */
    private function uploadToSpreadsheet($data, $sheetId)
    {
        $result = Sheets::spreadsheet(config('sheets.ttcl_api_data_spreadsheet_id'))
            ->sheetById($sheetId)
            ->range('B2:M1000')
            ->append($data);

        return $result;
    }
}
