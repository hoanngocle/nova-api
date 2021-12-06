<?php

namespace App\Crawler;

use Goutte\Client;
use Illuminate\Support\Arr;
use Revolution\Google\Sheets\Facades\Sheets;
use Symfony\Component\DomCrawler\Crawler;

class KamihimeMonsterEngVer
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
        $listGirlInformation = [];

        $crawler->filter('div#tabber-24eefac6e53229491064387252a01f61 div.tabbertab[title="' . $this->type . ' "] table tr')->each(
            function (Crawler $node) use (&$listGirlInformation) {
                if ($node->filter('td:nth-child(1) a')->count() > 0) {
                    $href = $node->filter('td:nth-child(1) a')->attr('href');
                    $name = $node->filter('td:nth-child(1) a')->text();
                    $additionalInfo = $this->crawInfo($href);

                    $imgSrc = $node->filter('td:nth-child(2) a img')->attr('data-src');
                    $imgName = $node->filter('td:nth-child(2) a img')->attr('alt');

                    $rarity = $node->filter('td:nth-child(3) a img')->attr('alt');
                    $element = $node->filter('td:nth-child(4) a img')->attr('alt');

                    $minAtk = $node->filter('td:nth-child(6)')->text();
                    $minHP = $node->filter('td:nth-child(8)')->text();

                    $girlInfo = [
                        'name' => $name,
                        'url' => $href,
                        'portrait' => $imgSrc,
                        'portrait_name' => $imgName,
                        'image_base' => $additionalInfo['image'][0] ?? '',
                        'image_sub' => $additionalInfo['image'][1] ?? '',
                        'rarity' => $rarity,
                        'element' => $element,
                        'min_atk' => $minAtk,
                        'min_hp' => $minHP,
                        'burst' => $additionalInfo['skill']['burst'] ?? '',
                        'burst_description' => $additionalInfo['skill']['burst_description'] ?? '',
                        'passive' => $additionalInfo['skill']['passive'] ?? '',
                        'passive_description' => $additionalInfo['skill']['passive_description'] ?? '',
                    ];

                    array_push($listGirlInformation, $girlInfo);
                }
            }
        );

        $this->uploadToSpreadsheet($listGirlInformation, config('sheets.monster_sheet_id'));

        return true;
    }

    /**
     * Craw more data information
     *
     * @param $url
     * @param $monsterName
     * @return array
     */
    private function crawInfo($url)
    {
        $listImgUrl = [];
        $girlSkill = [];
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

        $exception = [
            'https://kamihime-project.fandom.com/wiki/Aurora_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Guilty_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Ignited_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Lightning_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Ray_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Tempest_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Aqua_Kaiser_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Evil_Kaiser_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Gale_Kaiser_Dragoon',
            'https://kamihime-project.fandom.com/wiki/God_Kaiser_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Nova_Kaiser_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Pulse_Kaiser_Dragoon',
            'https://kamihime-project.fandom.com/wiki/Aratron',
            'https://kamihime-project.fandom.com/wiki/Bethor',
            'https://kamihime-project.fandom.com/wiki/Byakko',
            'https://kamihime-project.fandom.com/wiki/Genbu',
            'https://kamihime-project.fandom.com/wiki/Haggith',
            'https://kamihime-project.fandom.com/wiki/Ophiel',
            'https://kamihime-project.fandom.com/wiki/Och',
            'https://kamihime-project.fandom.com/wiki/Phaleg',
            'https://kamihime-project.fandom.com/wiki/Phul',
            'https://kamihime-project.fandom.com/wiki/Seiryu',
            'https://kamihime-project.fandom.com/wiki/Southern_Star_Lord',
            'https://kamihime-project.fandom.com/wiki/Suzaku',
        ];

        if ($crawler->filter('tr:nth-child(10)')->count() > 0) {
            $burst = $crawler->filter('tr:nth-child(10) > th')->text();
            $burst_description = $crawler->filter('tr:nth-child(11) > td:nth-child(1)')->text();

            if (in_array($url, $exception)) {
                $passive = $crawler->filter('tr:nth-child(17) > th')->text();
                $passive_description = $crawler->filter('tr:nth-child(18) > td:nth-child(2)')->text();
            } else {
                $passive = $crawler->filter('tr:nth-child(12) > th')->text();
                $passive_description = $crawler->filter('tr:nth-child(13) > td:nth-child(2)')->text();
            }

            $girlSkill = [
                'burst' => $burst,
                'burst_description' => $burst_description,
                'passive' => $passive,
                'passive_description' => $passive_description
            ];
        }

        return [
            'image' => $listImgUrl,
            'skill' => $girlSkill
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
