<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        try {
            if (Auth::check()) {
                return response()->json(['message' => 'Already logged in'], 400);
            }

            $request->authenticate();

            $request->session()->regenerate();

            return response()->json(['message' => 'Authenticated', 'user'=>Auth::user()], 200);
        }catch (\Exception $e) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
    }
    public function isAuth(){
        try {
            return response()->json(Auth::user());
            if (Auth::user()) {
                return response()->json(['message' => 'Authenticated', 'user'=>Auth::user()], 200);
            }else{
                return response()->json(['message' => 'Not logged in'], 401);
            }
        }catch (\Exception $e) {
            return response()->json(['error' => $e], 401);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
       try{
           Auth::guard('web')->logout();

           $request->session()->invalidate();

           $request->session()->regenerateToken();


           return response()->json([
               'message' => 'Logged out successfully'
           ]);
       }catch (\Exception $exception) {
           return \response()->json([
               'message' => $exception->getMessage()
           ], 300);
       }
    }
}
