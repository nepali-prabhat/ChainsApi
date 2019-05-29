<?php
namespace App\Http\Middleware;
use Closure;
use Exception;
use App\User;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->get('token');
        if(!$token) {
            // Unauthorized response if token not there
            return response()->json([
                'success' => false,
                "msg"=>"token is not provided."
            ], 401);
        }
        try {
            $payload = JWT::decode($token, env("APP_KEY"), ['HS256']);
        } catch(ExpiredException $e) {
            return response()->json([
                'success' => false,
                "msg"=>"token is expired."
            ], 400);
        } catch(Exception $e) {
            return response()->json([
                'success' => false,
                "msg"=>"failed to verify token."
            ], 400);
        }
        //$users = User::find($payload->id);
        $request->auth = $payload->id;
        return $next($request);
    }
}
