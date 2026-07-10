<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;

class AdminService
{
    private UserRepository $userRepository;
    private $limit = 1;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAll($this->limit);
    }

    public function getAllUserSearch($search)
    {
        return $this->userRepository->allSearch($search, $this->limit);
    }
}
