<?php

namespace App\Repository;

use App\Entities\User;
use App\Support\Pagination\Entity\Paginate;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    /**
     * @param Paginate|null $paginate
     * @return Collection
     */
    public function all(Paginate $paginate = null): Collection;

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User;

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User;

    /**
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data): User;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
