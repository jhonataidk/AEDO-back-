<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $profiles
     * @return mixed
     */
    public function handle($request, Closure $next, $profiles)
    {
        // Obter o usuário autenticado
        $user = Auth::guard('api')->user();

        // Verificar se o usuário está autenticado
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        // Verificar se o profile_id do usuário está nos perfis permitidos
        $allowedProfiles = explode(',', $profiles);

        if (!in_array($user->id_perfil, $allowedProfiles)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        // Passar a solicitação adiante
        return $next($request);
    }
}
