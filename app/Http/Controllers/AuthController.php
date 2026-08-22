<?php

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResources;
use App\Services\AuthStrategyResolver;

class AuthController extends Controller
{
    public function __construct(private AuthStrategyResolver $resolver)
    {}

    public function login(UserRequest $request ,string $type)
    {
        //
        $strategy = $this->resolver->resolve($type);

        return $strategy->login($request);
    }

    public function logout(UserRequest $request ,string $type){
        //
        $strategy = $this->resolver->resolve($type);
        return $strategy->logout($request);
    }

    public function user(UserRequest $request){
        //
        return response()->json([
            'user' => new UserResources($request->user())
        ],200);
    }
}