<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Service\Admin\AdminServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected $adminServiceInterface;
    public function __construct(AdminServiceInterface $adminServiceInterface)
    {
        $this->adminServiceInterface = $adminServiceInterface;
    }

    public function index() {
        return $this->adminServiceInterface->test();
    }

    public function login(Request $request) {
        if (!Auth::attempt($request->only('name','password'))) {
            throw new AuthenticationException();
        }

        $request->session()->regenerate();

        return response()->json(['message' => 'OK'], 201);
    }

    public function register(Request $request) {
        $rules = array(
            'name' => 'required|unique:admins',
            'password' => 'required',
        );
        $messages = array(
            'name.required' => 'name field is required.',
            'password.required' => 'password field is required.'
        );

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
        $messages = $validator->messages();
        return response()->json($messages, 400);
        }


        return $this->adminServiceInterface->register($request);
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'OK'], 200);
    }
}
