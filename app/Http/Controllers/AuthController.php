<?php

namespace App\Http\Controllers;

use App\Expediente;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Auth;
use App\User;
use App\Perfil;
use JWTAuth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'jwt.auth',
            ['except' => ['login', 'register', 'listaMedico']],
            ['only' => ['registerMedico,update']]
        );
    }

    protected function guard()
    {
        return Auth::guard('api');
    }

    public function register(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'primerApellido' => 'required',
                'segundoApellido' => 'required',
                'sexo' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->primerApellido = $request->primerApellido;
        $user->segundoApellido = $request->segundoApellido;
        $user->sexo = $request->sexo;
        $user->especialidad_id = null;
        $user->rol_id = 3;



        if (User::where('email', $user->email)->exists()) {
            return response()->json(['msg' => 'Email ya está registrado'], 404);
        }
        if ($user->save()) {
            $perf = new Perfil();
            $perf->nombre = $user->name;
            $perf->primerApellido = $user->primerApellido;
            $perf->segundoApellido = $user->segundoApellido;
            $perf->sexo = $user->sexo;
            $perf->fechaNacimiento = $request->fechaNacimiento;
            $perf->perfilPrincipal = 1;
            $perf->user()->associate($user->id);

            if ($perf->save()) {
                $exp = new Expediente();
                $exp->perfil_id = $user->id;
                $exp->tipo_sangre_id = 0;
                $exp->tipoSangre()->associate($request->input('tipoSangre_id'));
                $exp->perfil()->associate($perf->id);
            }
        }

        return response()->json([
            'user' => $user,
            'perfil' => $perf,
            'expediente' => $exp
        ]);
    }

    public function listaMedico(Request $request)
    {

        try {
            $med = DB::table('users')
                ->join('roles', 'users.rol_id', '=', 'roles.id')
                ->join('especialidades', 'especialidades.id', '=', 'users.especialidad_id')
                ->select('users.name', 'users.primerApellido', 'users.segundoApellido', 'especialidades.nombre as Especialidad')
                ->where('users.rol_id', 2)->where('name', 'like', "%{$request->filtro}%")
                ->orWhere('primerApellido', 'like', "%{$request->filtro}%")
                ->orWhere('segundoApellido', 'like', "%{$request->filtro}%")->get();

            // $med=User:: where('rol_id',2)->
            // where('name','like', "%{$request->filtro}%")
            // ->orWhere('primerApellido','like', "%{$request->filtro}%")
            // ->orWhere('segundoApellido','like', "%{$request->filtro}%")-> get();
            $response = [
                'msg' => 'Lista de médicos',
                'médico' => $med
            ];



            return response()->json($response, 200);
        } catch (\Exception $e) {
            return \response($e->getMessage(), 422);
        }
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        $token = $this->guard()->attempt($credentials);
        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'password' => 'required|min:6',
                'primerApellido' => 'required',
                'segundoApellido' => 'required',
                'sexo' => 'required',
            ]);
            //Obtener el usuario autentificado actual
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
        $user = User::find($id);

        $user->name = $request->input('name');
        $user->password = bcrypt($request->input('password'));
        $user->primerApellido = $request->input('primerApellido');
        $user->segundoApellido = $request->input('segundoApellido');
        $user->sexo = $request->input('sexo');

        // $user->type()->associate($request->input('especialidad_id'));

        if ($user->update()) {

            //Property con características
            $users = User::where('id', $id)->first();
            $response = [
                'msg' => 'Usuario actualizado!',
                'Usuario' => $users
            ];
            return response()->json($response, 201);
        }
        $reponse = [
            'msg' => 'Error durante la actualización'
        ];
        return response()->json($response, 404);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }



    public function registerMedico(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6',
                'primerApellido' => 'required',
                'segundoApellido' => 'required',
                'sexo' => 'required',
            ]);
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'Usuario no encontrado'], 404);
            }
            if ($user->rol_id !== 1) {
                return response()->json(['msg' => 'Usuario no autorizado'], 404);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return \response($e->errors(), 422);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->primerApellido = $request->primerApellido;
        $user->segundoApellido = $request->segundoApellido;
        $user->sexo = $request->sexo;
        $user->especialidad()->associate($request->input('especialidad_id'));
        $user->rol_id = 2;

        if (User::where('email', $user->email)->exists()) {
            return response()->json(['msg' => 'Email ya está registrado'], 404);
        }
        $user->save();
        return response()->json(['user' => $user]);
    }
}
