<?php

namespace AnimalFriend\Repositories;
 
use AnimalFriend\Pet;
use AnimalFriend\Repositories\Interfaces\PetRepositoryInterface;
 
class EloquentPetRepository implements PetRepositoryInterface {
 
    private $pet;

    public function __construct(Pet $pet)
    {
        $this->pet = $pet;
    }

    public function all()
    {
        return $this->pet->all();
    }
 
    public function findOrFail($id)
    {
        return $this->pet->findOrFail($id);
    }
 
    public function create($input)
    {
        return $this->pet->create($input);
    }
}
