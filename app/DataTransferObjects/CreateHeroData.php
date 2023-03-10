<?php

namespace App\DataTransferObjects;

use App\Http\Requests\Hero\CreateHeroRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateHeroData extends DataTransferObject
{
    public string $name;
    public string $bio;
    public string $avatar;
    public int $rarity;
    public int $element;
    public int $type;
    public int $status;

    /**
     * @param CreateHeroRequest $request
     * @return CreateHeroData
     * @throws UnknownProperties
     */
    public static function fromRequest(CreateHeroRequest $request): CreateHeroData
    {
        $inputs = $request->validated();

        return new self([
            'name'          => $inputs['name'],
            'bio'           => $inputs['bio'],
            'avatar'        => $inputs['avatar'],
            'rarity'        => $inputs['rarity'],
            'element'       => $inputs['element'],
            'type'          => $inputs['type'],
            'status'        => $inputs['status'],
        ]);
    }
}
