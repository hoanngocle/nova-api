<?php

namespace App\Crawler;

use Goutte\Client;
use Revolution\Google\Sheets\Facades\Sheets;
use Symfony\Component\DomCrawler\Crawler;

class KamihimeEquipment
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

        $crawler->filter('div#tabber-f22302530977f4d5cf0b8f5f9fe2278f > div.tabbertab[title="'. $this->type .' "] > table > tbody > tr')->each(
            function (Crawler $node) use (&$listEquipInformation) {
                if ($node->filter('td:nth-child(1)')->count() > 0) {
                    $name = $node->filter('td:nth-child(1)')->text();
                    $imgSrc = $node->filter('td:nth-child(2) a img')->attr('data-src');
                    $imgName = $node->filter('td:nth-child(2) a img')->attr('alt');
                    $type = $node->filter('td:nth-child(3) a img')->attr('alt');
                    $element = $node->filter('td:nth-child(4) a img')->attr('alt');
                    $effect = $node->filter('td:nth-child(5)')->text();
                    $maxLv = $node->filter('td:nth-child(6)')->text();
                    $minAtk = $node->filter('td:nth-child(7)')->text();
                    $minHP = $node->filter('td:nth-child(9)')->text();

                    $equipmentInfo = [
                        'name' => $name,
                        'type' => $type,
                        'image' => $imgSrc,
                        'image_name' => $imgName,
                        'element' => $element,
                        'effect' => $effect,
                        'max_lv' => $maxLv,
                        'min_atk' => $minAtk,
                        'min_HP' => $minHP,
                    ];

                    array_push($listEquipInformation, $equipmentInfo);
                }
            }
        );

        $this->uploadToSpreadsheet($listEquipInformation, config('sheets.weapon_sheet_id'));

        return true;
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
