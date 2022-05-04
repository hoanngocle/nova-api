<?php

namespace App\Crawler;

use Goutte\Client;
use Illuminate\Support\Arr;
use Symfony\Component\DomCrawler\Crawler;

class FoodCalo
{
    public function scrape()
    {
        $client = new Client();

        $url = 'https://beautyhealth.vn/kien-thuc/bang-nang-luong-cua-vien-dinh-duong-viet-nam-2021';
        $crawler = $client->request('GET', $url);
        $listFood = [];

        $crawler->filter('tbody tr')->each(
            function (Crawler $node) use (&$listFood) {
                $name = $node->filter('td:nth-child(1)')->text();
                $unit = $node->filter('td:nth-child(2)')->text();
                $calo = $node->filter('td:nth-child(3)')->text();
                $listFood = [
                    'name' => $name
                ];
            }

        );

        $this->uploadToDatabase(Arr::collapse($listFood), config('sheets.girl_skill_sheet_id'));

        return true;
    }


    /**
     * @param $data
     * @param $sheetId
     * @return mixed
     */
    private function uploadToDatabase($data)
    {


        return $result;
    }
}
