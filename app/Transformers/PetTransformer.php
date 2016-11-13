<?php

namespace AnimalFriend\Transformers;

use AnimalFriend\Pet;
use League\Fractal;

class PetTransformer extends Fractal\TransformerAbstract
{
    public function transform(Pet $pet)
    {
        return [
            'id'            => (int) $pet->id,
            'name'          => (string) $pet->name,
            'type'          => (string) $pet->type,
            'available'     => (bool) $pet->available,
            'picture'       => (string) $pet->picture
        ];
    }
}
