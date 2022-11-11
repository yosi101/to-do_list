<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:4'],
            'email' => ['required', 'email', 'unique:users', 'string'],
            'password' => ['required', 'min:4', 'string', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $success['token'] = $user->createToken('MyApiToken')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User successfully created'

        ];

        return response()->json($response, 200);
    }

    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => ['required', 'email', 'string'],
        //     'password' => ['required', 'min:4', 'string']
        // ]);

        // if (Auth::attempt($request->only('email', 'passwords'))) {
        //     return response()->json(
        //         Auth::user(), 200
        //     );
        // }
        // throw ValidationException::withMessages([
        //     'email' => ['The provided credentials are invalid']
        // ]);
        $credentials = $request->only(['email', 'password']);

        $validator = Validator::make($credentials, [
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'min:4', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json(['errors' => 'Unauthorized'], 401);
        }

        /* ------------ Create a new personal access token for the user. ------------ */
        $user = User::where('email', $request->email)->firstOrFail();
        $success['token'] = $user->createToken('MyApiToken')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User successfully created'

        ];

        return response()->json($response, 200);
    }

    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'logout successful';
        }catch (\Illuminate\Database\QueryException $ex){
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            $success,
            $message
        ];

        return response()->json($response);

    }
}
