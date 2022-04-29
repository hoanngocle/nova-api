<?php

namespace App\Services;

use App\Repositories\Hero\HeroRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;

class HeroService
{
    protected HeroRepositoryInterface $heroRepository;

    /**
     * AuthServices constructor.
     * @param HeroRepositoryInterface $heroRepository
     */
    public function __construct(HeroRepositoryInterface $heroRepository)
    {
        $this->heroRepository = $heroRepository;
    }

    /**
     * @param $request
     * @return bool
     * @throws Exception
     */
    public function processLogin($request): bool
    {

    }

    /**
     * Destroy all sessions for the current logged-in hero
     */
    public function logout()
    {
        return auth()->hero()->tokens()->delete();
    }

    /**
     * Get profile of hero
     *
     */
    public function getProfile()
    {
        $idHero = auth()->hero();
        return $this->heroRepository->find($idHero);
    }

    /**
     * Validate provider (facebook, google, github)
     *
     * @param $provider
     * @return JsonResponse|null
     */
    public function validateProvider($provider): ?JsonResponse
    {
        if (!in_array($provider, config("constant.SOCIAL_ARRAY"))) {
            return response()->json(
                ['error' => __("auth.provider.error")],
                config("constant.HTTP_CODE.UNPROCESSABLE")
            );
        }

        return null;
    }

    /**
     * Get hero or create if not found
     *
     * @param $provider
     * @param $hero
     * @return mixed
     */
    public function firstOrCreateHero($provider, $hero): mixed
    {
        return $this->heroRepository->firstOrCreateHero($provider, $hero);
    }

    /**
     * Create new hero
     *
     * @param $request
     * @return mixed
     */
    public function registerHero($request): mixed
    {
        $input = $request->all();
        $input['password'] = bcrypt($request['password']);

        return $this->heroRepository->create($input);
    }
}
