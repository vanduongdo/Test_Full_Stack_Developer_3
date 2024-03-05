<?php

namespace App\Repository\Interfaces;

interface UserRepositoryInterface {
    public function signup($data = []);
}