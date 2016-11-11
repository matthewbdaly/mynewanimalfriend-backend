<?php

namespace AnimalFriend\Repositories\Interfaces;

interface UserRepositoryInterface {
    public function all();

    public function findOrFail($id);

    public function create($input);
}
