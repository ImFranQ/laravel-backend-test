<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function login(Request $request){
        
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if( $user !== null && Hash::check($password, $user->password) ){
            $token = $user->createToken($email);
            return ['token' => $token->plainTextToken];
        }

        return response()->json(['error' => 'Credentials does not match'], 404);

    }

    public function logout (Request $request) {
        return [
            'success' => $request->user()->currentAccessToken()->delete()
        ];
    }
}
