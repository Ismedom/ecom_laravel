<?php

   /*

    - My authentication method using Laravel Sanctum with username, email and password 
    
    */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
/** @var \Laravel\Sanctum\HasApiTokens|\App\Models\User $user */

class UserController extends Controller
{

    // Sign In part

    public function signIn(Request $request) {
        try {
            $credentials = $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required'
            ]);
        
            if (Auth::attempt($credentials)) {
                $token =Auth::user()->createToken($request->name, ['*'], expiresAt: now()->addDays(30))->plainTextToken; 
                return response()->json(['user_token' => $token]);
            }
        
        
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
            
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }
    

    // Register part


    public function register(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:8'
            ]);
        
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
        
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
            ]);
            
            $token = $user->createToken($request->name, ['*'], now()->addDays(30))->plainTextToken;
            return response()->json(['user_token'=>$token]);
        } catch (ValidationException $e) {
            return response()->json([
                'errors' => $e->errors()
            ], 422);
        }
    }
    

//  the deleting use routing
    public function delete_user()
    {
        try {
            $user = User::find(Auth::id());
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
    
            $user->delete();
            return response()->json(["message" => "User deleted successfully"]);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
    
    
     // Log Out part
    public function logOut(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}