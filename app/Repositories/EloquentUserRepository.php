<?php

namespace AnimalFriend\Repositories;
 
use AnimalFriend\User;
use AnimalFriend\Repositories\Interfaces\UserRepositoryInterface;
use JWTAuth;
use Hash;
 
class EloquentUserRepository implements UserRepositoryInterface {
 
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function all()
    {
        return $this->user->all();
    }
 
    public function findOrFail($id)
    {
        return $this->user->findOrFail($id);
    }
 
    public function create($input)
    {
        $user = new $this->user;
        $user->email = $input['email'];
        $user->name = $input['name'];
        $user->password = Hash::make($input['password']);
        $user->save();

        // Create token
        return JWTAuth::fromUser($user);
    }
}
