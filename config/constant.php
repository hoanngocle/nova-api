<?php

// HTTP Status code
define('HTTP_SUCCESS', 200);
define('HTTP_CREATED', 201);
define('HTTP_ACCEPTED', 202);
define('HTTP_NO_CONTENT', 204);
define('HTTP_RESET_CONTENT', 205);
define('HTTP_BAD_REQUEST', 400);
define('HTTP_UNAUTHORIZED', 401);
define('HTTP_PAYMENT_REQUIRED', 402);
define('HTTP_FORBIDDEN', 403);
define('HTTP_NOT_FOUND', 404);
define('HTTP_METHOD_NOT_ALLOWED', 405);
define('HTTP_NOT_ACCEPTABLE', 406);
define('HTTP_REQUEST_TIMEOUT', 408);
define('HTTP_CONFLICT', 409);
define('HTTP_UNPROCESSABLE', 422);
define('HTTP_INTERNAL_SERVER_ERROR', 500);
define('HTTP_NOT_IMPLEMENTED', 501);
define('HTTP_BAD_GATEWAY', 502);
define('HTTP_SERVICE_UNAVAILABLE', 503);
define('HTTP_GATEWAY_TIMEOUT', 504);
define('HTTP_VERSION_NOT_SUPPORTED', 505);

define('ACTIVE', 1);
define('INACTIVE', 0);

// Basic table
const TBL_USER                  = 'users';
const TBL_CHARACTER             = 'characters';

const TBL_CHARACTER_STAT        = 'character_stats';
const TBL_CHARACTER_SKILL       = 'character_skill';
const TBL_CHARACTER_INVENTORY   = 'character_inventory';
const TBL_LOGIN_HISTORY         = 'login_histories';

// Master table
const TBL_CATEGORY      = 'categories';
const TBL_ITEM          = 'items';
const TBL_SKILL         = 'skills';
const TBL_SKILL_INFO    = 'skill_infos';
const TBL_WAIFU         = 'waifus';
const TBL_WAIFU_COSTUME = 'waifu_costumes';
const TBL_EQUIPMENT     = 'equipments';
const TBL_EQUIPMENT_SET = 'equipment_sets';

//
const TBL_COURSE = 'courses';
const TBL_SET = 'sets';
const TBL_TERM = 'terms';
const TBL_RECORD = 'records';

// URL Crawler
const FKG_FANDOM_WIKI_URL = 'https://flowerknight.fandom.com/wiki/Flower_Knight_Girl_Wikia';
const FKG_DMM_WIKI_URL = 'https://harem-battle.club/wiki/';

const KAMIHIME_FANDOM_WIKI_URL = 'https://kamihime-project.fandom.com';
const KAMIHIME_DMM_WIKI_URL = 'https://xn--hckqz0e9cygq471ahu9b.xn--wiki-4i9hs14f.com/';

// URL Type
const FKG_UNIT = 'FKG:Units';
const FKG_STORY = 'FKG:Campaign';

const KAMIHIME_GIRL = '/wiki/Kamihime#All_';
const KAMIHIME_MONSTER = '/wiki/Eidolons';
const KAMIHIME_SOUL = '/wiki/Souls/List';
const KAMIHIME_EQUIPMENT = '/wiki/Accessories';
const KAMIHIME_WEAPON = '/wiki/Weapons/List';

// ENGLISH LEVEL
const LEVEL_BEGINNER = '1';
const LEVEL_ELEMENTARY = '2';
const LEVEL_PRE_INTERMEDIATE = '3';
const LEVEL_INTERMEDIATE = '4';
const LEVEL_UPPER_INTERMEDIATE = '5';
const LEVEL_PRE_ADVANCED = '6';
const LEVEL_ADVANCED = '7';
