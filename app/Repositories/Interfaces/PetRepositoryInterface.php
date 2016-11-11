<?php

namespace AnimalFriend\Repositories\Interfaces;

interface PetRepositoryInterface {
    public function all();

    public function findOrFail($id);

    public function create($input);
}
