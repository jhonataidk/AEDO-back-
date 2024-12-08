<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Handle user login and generate an access token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        // Receive the credentials (email and password)
        $data = $request->only('email', 'password');

        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Log the input for debugging purposes
        Log::info('Login attempt with email: ' . $data['email']);

        // Attempt to authenticate the user with the provided credentials
        if (Auth::attempt(['email' => strtolower($data['email']), 'password' => $data['password']])) {
            // If authentication is successful, get the authenticated user
            $user = auth()->user();

            // Create an access token for the authenticated user
            $user->token = $user->createToken($user->email)->accessToken;

            // Return success response with user data and token
            return response()->json([
                'status' => 200,
                'message' => 'Usuário logado com sucesso',
                'usuario' => $user,
                'token' => $user->token
            ], 200);
        } else {
            // Log the failed authentication attempt
            Log::warning('Failed login attempt with email: ' . $data['email']);

            // If authentication fails, return an error response
            return response()->json([
                'status' => 401,
                'message' => 'Usuário ou senha incorreto'
            ], 401);
        }
    }

    /**
     * Logout the user and revoke the access token.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        // Revoke the current access token
        $request->user()->token()->revoke();

        return $this->successfulLogoutResponse();
    }

    /**
     * Return a successful logout response.
     *
     * @return JsonResponse
     */
    private function successfulLogoutResponse(): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'message' => 'Logout realizado com sucesso.',
        ], 200);
    }
}
