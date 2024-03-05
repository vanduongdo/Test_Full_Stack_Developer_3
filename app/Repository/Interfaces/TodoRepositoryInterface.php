<?php

namespace App\Repository\Interfaces;

interface TodoRepositoryInterface {
    public function index();
    public function storage($data = []);
    public function update($id, $data = []);
    public function delete($id);
    public function updateSubscription($package_id, $user_id);
}