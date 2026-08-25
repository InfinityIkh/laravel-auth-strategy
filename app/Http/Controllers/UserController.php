<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResources;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();

        return UserResources::collection($users);
    }

    /**
     * Store a newly created user.
     */
    public function store(UserRequest $request)
    {
        $user = $this->userService->createUser(
            $request->validated()
        );

        return (new UserResources($user))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        $user = $this->userService->getUser($user);

        return new UserResources($user);
    }

    /**
     * Update the specified user.
     */
    public function update(
        UserRequest $request,
        User $user
    ) {
        $user = $this->userService->updateUser(
            $user,
            $request->validated()
        );

        return new ($user);
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userService->deleteUser($user);

        return response()->json([
            'message' => 'User deleted successfully.'
        ]);
    }
}