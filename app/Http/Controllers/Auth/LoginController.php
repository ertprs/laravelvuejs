<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
   public function login(HttpRequest $request)
   {
       $cEmail      =   $request->cEmail;
       $cContrasena =   $request->cContrasena;

       $rpta = Auth::attempt(['email' => $cEmail, 'password' => $cContrasena, 'state' => 'A']);

       if($rpta){
           return response()->json([
               'authUser' => Auth::user(),
               'code'     => 200
           ]);
       }
       else{
           return response()->json([
            'code'     => 401
        ]);
       }
   }

   public function logout(HttpRequest $request)
   {
       Auth::logout();
       return response()->json([
        'code'     => 204
        ]);
   }
}
