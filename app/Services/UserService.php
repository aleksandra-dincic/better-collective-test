<?php

namespace App\Services;

use App\Entities\User;
use App\Repository\UserRepositoryInterface;
use App\Support\Pagination\Entity\Paginate;
use Illuminate\Support\Collection;

class UserService
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Paginate $pagination
     * @return Collection
     */
    public function getAllUsers(Paginate $pagination): Collection
    {
        return $this->userRepository->all($pagination);
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        return $this->userRepository->store($data);
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User
    {
        return $this->userRepository->findById($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data): User
    {
        return $this->userRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function deleteUserById(int $id): void
    {
        $this->userRepository->delete($id);
    }
}
