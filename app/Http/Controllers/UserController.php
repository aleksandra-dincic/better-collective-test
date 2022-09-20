<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ResponseTrait;
use App\Services\UserService;
use App\Support\Pagination\Traits\PaginationTrait;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserController extends Controller
{
    use ResponseTrait;
    use PaginationTrait;

    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Response
     */
    public function index(): Response
    {
        $pagination = $this->getPagination();

        try {
            $users = $this->userService->getAllUsers($pagination);
            $metaData = $this->getPaginationMetaData($pagination, $users);
        } catch (HttpException $exception) {
            return $this->response($exception->getStatusCode(), $exception->getMessage());
        }

        return $this->response(200, "", UserResource::collection($users), $metaData);
    }

    /**
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request): Response
    {
        try {
            $user = $this->userService->store($request->getAllFields());
        } catch (HttpException $exception) {
            return $this->response($exception->getStatusCode(), $exception->getMessage());
        }

        return $this->response(201, "User created successfully", new UserResource($user));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        try {
            $user = $this->userService->getUserById($id);
        } catch (HttpException $exception) {
            return $this->response($exception->getStatusCode(), $exception->getMessage());
        }

        return $this->response(200, "User successfully retrieved", new UserResource($user));
    }

    /**
     * @param UserRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UserRequest $request, int $id): Response
    {
        try {
            $user = $this->userService->update($id, $request->getAllFields());
        } catch (HttpException $exception) {
            return $this->response($exception->getStatusCode(), $exception->getMessage());
        }

        return $this->response(200, "User successfully updated", new UserResource($user));
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        try {
            $this->userService->deleteUserById($id);
        } catch (HttpException $exception) {
            return $this->response($exception->getStatusCode(), $exception->getMessage());
        }

        return $this->response(204, "User successfully deleted");
    }
}
