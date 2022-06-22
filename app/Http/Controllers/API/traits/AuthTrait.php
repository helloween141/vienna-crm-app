<?php
namespace App\Http\Controllers\API\traits;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

trait AuthTrait {
    /**
     * Create
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            $success = true;
            $message = 'Пользователь успешно создан';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }

    /**
     * Login
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'Вы были успешно авторизированы'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Вы ввели неверный e-mail или пароль'
        ]);
    }

    /**
     * Logout
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Вы успешно вышли';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message,
        ];

        return response()->json($response);
    }
}
