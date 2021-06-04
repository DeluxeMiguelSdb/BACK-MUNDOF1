<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleAuthController extends Controller
{
    public function UserPermissions(Request $request)
    {
        $user = $request->user();
        $rol = $request->rol;

        if($user->hasRole([$rol])){
            $data = ["data" => true];
            return response()->json($data,200);
        }

        $data = ["data" => false];
        return response()->json($data,200);

    }
}
