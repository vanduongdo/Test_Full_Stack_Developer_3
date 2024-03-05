<?php

namespace App\Repository\Eloquent;

use App\Repository\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    protected $model;
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function signup($data = []) {
        $user = $this->model->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return $user;
    }

}
