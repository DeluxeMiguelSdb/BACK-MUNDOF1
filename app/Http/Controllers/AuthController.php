<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\LogsHistory;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $messages = array(
            'nick.unique' => 'Nick ya escogido',
            'nick.required' => 'Por favor, introduce el nick',
            'email.required' => 'Porfavor introduce tu email',
            'email' => 'El formato del email no es valido',
            'email.unique' => 'Este Correo ya esta registrado',
            'nombre.required' => 'Porfavor introduce tu nombre',
            'apellidos.required' => 'Porfavor introduce tu apellido',
            'password.required' => 'Porfavor introduce una contraseña.'
        );

        $validator = Validator::make($request->all(), [
            'nick' => 'required|max:55|unique:users',
            
            'email' => 'email|required|unique:users',
            'nombre' => 'required|max:55',
            'apellidos' => 'required|max:55',
            'password' => 'required|confirmed'
        ], $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response(['data' => $errors],401);
        }


        $user = User::create([
            'nick' => $request->nick,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->assignRole('Usuario');

        $token = $user->createToken('auth_Token')->plainTextToken;

        event(new LogsHistory(
            $user->id,
            $user->nick,
            Config::get('constants.pages.page_registro'),
            Config::get('constants.actions.register'),
        ));

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);

        
        
        
    }

    public function concederpermisoadmin(Request $request)
    {

        $user = User::findOrFail($request->id);

        $user->assignRole('Admin');

        $user->save();

        return response()->json([
            'mensaje' => "Rol Administrador asignado a $user->nick"],
            200);

        
        
        
    }

    public function changeNick(Request $request)
    {

        $nick = $request->nick;
        $messages = array(
            'nick.unique' => 'Nick ya escogido',
        );

        $validator = Validator::make($request->all(), [
            'nick' => 'required|max:55|unique:users',
        ], $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response(['data' => $errors],401);
        }


        $user = User::find(Auth::user()->id);

        $user->nick = $nick;

        $user->save();


        return response()->json([
            'mensaje' => "Nick cambiado con éxito"],
            200);

    }

    public function changeNombre(Request $request)
    {

        $nombre = $request->nombre;
        $messages = array(
            'nombre.required' => 'Porfavor introduce tu nombre',
        );

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:55',
        ], $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response(['data' => $errors],401);
        }


        $user = User::find(Auth::user()->id);

        $user->nombre = $nombre;

        $user->save();


        return response()->json([
            'mensaje' => "Nombre cambiado con éxito"],
            200);

    }

    public function changeApellidos(Request $request)
    {

        $apellidos = $request->apellidos;
        $messages = array(
            'apellidos.apellidos' => 'Porfavor introduce tus apellidos',
        );

        $validator = Validator::make($request->all(), [
            'apellidos' => 'required|max:55',
        ], $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response(['data' => $errors],401);
        }


        $user = User::find(Auth::user()->id);

        $user->apellidos = $apellidos;

        $user->save();


        return response()->json([
            'mensaje' => "Apellidos cambiados con éxito"],
            200);

    }

    public function changePassword(Request $request)
    {

        $passwordOld = $request->passwordOld;
        $passwordNew = $request->passwordNew;
        $messages = array(
            'passwordOld.required' => 'Porfavor introduce una contraseña.',
            'passwordNew.required' => 'Porfavor introduce una contraseña.',
           // 'passwordOld.confirmed' =>'La contrasea actual no es correcta'
        );

        $validator = Validator::make($request->all(), [
            //'passwordOld' => 'required|confirmed',
        ], $messages);

        if ($validator->fails()) {
            $messages = $validator->messages();
            $errors = $messages->all();
            return response(['data' => $errors],401);
        }




        $user = User::find(Auth::user()->id);

        if (Hash::check($passwordOld, $user->password)) {
            $user->password = bcrypt($passwordNew);

            $user->save();

            return response()->json([
                'mensaje' => "Contraseña cambiada con éxito."],
                200);
        }

        $messages = array(
            0 => 'La contraseña acutal no es correcta.'
        );
        return response(['data' => $messages],401);

        

    }


    public function login(Request $request)
    {
        
        if (!Auth::attempt($request->only('nick', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('nick', $request['nick'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function getallusers(){
        $users =  User::where('id', '!=', Auth::User()->id)->get();

        $userMasRoles= [];


        foreach($users as $user){
            $user->getRoleNames();
            
            array_push($userMasRoles,$user);
            //$user->assignRole($role);
        }

        return $userMasRoles;
    }
    public function me(Request $request)
    {
        $user =  $request->user();
        

        $userMasRoles= [];

        $user->getRoleNames();
            
            array_push($userMasRoles,$user);

        return $user;

    }
}
