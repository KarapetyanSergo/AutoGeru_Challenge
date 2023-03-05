<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignInRequest;
use App\Http\Requests\SignUpRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function signUp(SignUpRequest $signUpRequest, AuthService $authService): JsonResponse
    {
        return response()->json($this->getSuccessResponse($authService->register($signUpRequest->name, $signUpRequest->email, $signUpRequest->password, $signUpRequest->user_type)));
    }

    public function signIn(SignInRequest $signInRequest, AuthService $authService): JsonResponse
    {
        try {
            $response = $authService->login($signInRequest->email, $signInRequest->password, $signInRequest->fcm_token);

            return response()->json($this->getSuccessResponse($response));
        } catch (Exception $e) {
            return response()->json($this->getErrorResponse($e->getMessage()), 400);
        }
    }

    public function signOut(AuthService $authService): JsonResponse
    {
        return response()->json($this->getSuccessResponse($authService->logOut()));
    }
}
