<?php

namespace App\Http\Controllers\API\Character;

use App\Http\Controllers\Controller;
use App\Repositories\Character\CharacterEloquentRepository;
use App\Repositories\Character\CharacterRepositoryInterface;
use App\Services\CharacterService;
use Illuminate\Http\Request;

class CharacterInfoController extends Controller
{

    protected CharacterService $characterService;

    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $userId = auth()->user()->id;

        $userInfo = $this->characterService->getCharacterInfo($userId);

        dd($userInfo);
    }
}
