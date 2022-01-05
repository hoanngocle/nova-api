<?php

return [
    'BASE_TEXT_TOKEN' => 'NewWorldOnline',
    // HTTP Status code
    'HTTP_CODE' => [
        'SUCCESS'               => 200,
        'BAD_REQUEST'           => 400,
        'UNAUTHORIZED'          => 401,
        'FORBIDDEN'             => 403,
        'NOT_FOUND'             => 404,
        'METHOD_NOT_ALLOWED'    => 405,
        'INTERNAL_SERVER_ERROR' => 500,
        'BAD_GATEWAY'           => 502,
        'GATEWAY_TIMEOUT'       => 504,
    ],
    'TBL' => [
        'USER'          => 'users',
        'PROFILE'       => 'profiles',
        'STAT'          => 'stats',
        'INVENTORY'     => 'inventories',
        'LOGIN_HISTORY' => 'login_histories',
        'IMAGES'        => 'images'
    ],
    'MASTER_TBL' => [
        'CATEGORY'  => 'master_categories',
        'ITEM'      => 'master_items',
        'PARTNER'   => 'master_partners',
        'COSTUME'   => 'master_costumes',
        'EQUIPMENT' => 'master_equipments',
    ]
];


//const TBL_RECORD = 'records';
//
//// URL Crawler
//const FKG_FANDOM_WIKI_URL = 'https://flowerknight.fandom.com/wiki/Flower_Knight_Girl_Wikia';
//const FKG_DMM_WIKI_URL = 'https://harem-battle.club/wiki/';
//
//const KAMIHIME_FANDOM_WIKI_URL = 'https://kamihime-project.fandom.com';
//const KAMIHIME_DMM_WIKI_URL = 'https://xn--hckqz0e9cygq471ahu9b.xn--wiki-4i9hs14f.com/';
//
//// URL Type
//const FKG_UNIT = 'FKG:Units';
//const FKG_STORY = 'FKG:Campaign';
//
//const KAMIHIME_GIRL = '/wiki/Kamihime#All_';
//const KAMIHIME_MONSTER = '/wiki/Eidolons';
//const KAMIHIME_SOUL = '/wiki/Souls/List';
//const KAMIHIME_EQUIPMENT = '/wiki/Accessories';
//const KAMIHIME_WEAPON = '/wiki/Weapons/List';
//
//// ENGLISH LEVEL
//const LEVEL_BEGINNER = '1';
//const LEVEL_ELEMENTARY = '2';
//const LEVEL_PRE_INTERMEDIATE = '3';
//const LEVEL_INTERMEDIATE = '4';
//const LEVEL_UPPER_INTERMEDIATE = '5';
//const LEVEL_PRE_ADVANCED = '6';
//const LEVEL_ADVANCED = '7';
