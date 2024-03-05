<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repository\Interfaces\UserRepositoryInterface;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    public function signup(SignupRequest $request) {

        $data = $request->validated();
        $data['name'] = isset($data['name']) ? $data['name'] : null;
        $data['email'] = isset($data['email']) ? $data['email'] : null;
        $data['password'] = isset($data['password']) ? $data['password'] : null;

        /** @var \App\Models\User $user */
        $user = $this->userRepository->signup($data);

        $token = $user->createToken('main')->plainTextToken;
        return response(compact('user', 'token'));
    }

       public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Provided email or password is incorrect'
            ], 422);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;
        return response(compact('user', 'token'));
    }

    public function logout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response('', 204);
    }

}
