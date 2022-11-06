<?php

namespace App\Http\Controllers;

use App\Models\Users_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use JWTAuth;
use JWTFactory;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;

class Users_ModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','create']]);
    }
    
    public function login(Request $request)
    {
        $val = Validator::make($request->all(),[
            'usuario' => 'required|string',
            'password' => 'required|string|min:8',
        ]);
        if($val->fails()){
            return response()->json($val->errors(),422);
        }
        //$password = Hash::make($request->password);
        $credentials = $request->only(['usuario', 'password']);
        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
    }
    
    public function create(Request $request)
    {
        //
        $val = Validator::make($request->all(),[
            'nombre'=>'required|string',
            'usuario'=>'required|string|unique:users_model',
            'password'=>'required|string|min:8',
        ]);
        if($val->fails()){
            return response()->json($val->errors(),422);
        }
        $user = Users_Model::create([
            'nombre'=> $request->nombre,
            'usuario'=>$request->usuario,
            'password'=>Hash::make($request->password),
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Usuario creado',
            'user' => $user,
            'token' => $token,
            'type' => 'bearer',
        ]);

    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
    
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'user' => JWTAuth::user(),
        ]);
    }
    
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => JWTAuth::user(),
            'authorisation' => [
                'token' => JWTAuth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
