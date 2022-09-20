<?php

namespace App\Repository\Eloquent;

use App\Entities\User;
use App\Models\User as UserModel;
use App\Repository\UserRepositoryInterface;
use App\Support\Pagination\Entity\Paginate;
use App\Support\Traits\AssociativeArrayTrait;
use App\Support\Traits\IDFormatterTrait;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    use IDFormatterTrait;
    use AssociativeArrayTrait;

    /**
     * @param UserModel $userModel
     */
    public function __construct(UserModel $userModel)
    {
        parent::__construct($userModel);
    }

    /**
     * @param Paginate|null $paginate
     * @return Collection
     */
    public function all(Paginate $paginate = null): Collection
    {
        $userCollection = new Collection();
        $model = new UserModel();

        if(!$model->doesFileExist()) {
            throw new NotFoundHttpException("Users' File not found");
        }
        $users = $model->getFromFile();
        if(empty($users)) {
            new Collection();
        }

        $users = !is_null($paginate) ? array_slice($users, $paginate->getPage() - 1, $paginate->getSize()) : $users;
        foreach ($users as $user) {
            $userCollection->push( new User($user->id, $user->name, Carbon::createFromDate($user->year_of_birth), Carbon::createFromDate($user->created_at)));
        }

        return $userCollection;
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        $users = [];

        $model = new UserModel();
        if($model->doesFileExist()) {
            $users = $model->getFromFile();
        }
        $id = $this->formatID($users);

        $user = new User($id, $data['name'], Carbon::createFromDate($data['year_of_birth']), Carbon::now());
        $users[] = $user->toArray();

        $model->storeInFile($users);

        return $user;
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        $model = new UserModel();

        if(!$model->doesFileExist()) {
            throw new NotFoundHttpException("Users' File not found");
        }
        $users = $model->getFromFile();

        $key = $this->findAssociativeID($id, $users);
        if(is_null($key)) {
            throw new NotFoundHttpException("User not found");
        }

        $user = $users[$key];

        return new User($user->id, $user->name, Carbon::createFromDate($user->year_of_birth), Carbon::createFromDate($user->created_at));
    }

    /**
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data): User
    {
        $model = new UserModel();

        if(!$model->doesFileExist()) {
            throw new NotFoundHttpException("Users' File not found");
        }
        $users = $model->getFromFile();

        $key = $this->findAssociativeID($id, $users);
        if(is_null($key)) {
            throw new NotFoundHttpException("User not found");
        }

        $user = new User($id, $data['name'], Carbon::createFromDate($data['year_of_birth']), Carbon::now());
        $users[$key] = $user->toArray();

        $model->storeInFile($users);

        return $user;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $model = new UserModel();

        if(!$model->doesFileExist()) {
            throw new NotFoundHttpException("Users' File not found");
        }
        $users = $model->getFromFile();

        $key = $this->findAssociativeID($id, $users);
        if(is_null($key)) {
            throw new NotFoundHttpException("User not found");
        }

        unset($users[$key]);

        $model->storeInFile(array_values($users));
    }
}
