<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Service\Admin\AdminServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validate([
            'name' => 'required|unique:admins',
            'kpay' => 'required',
            'wave' => 'required',
            'cbpay' => 'required',
            'ok' => 'required',
        ]);
        return $this->adminServiceInterface->register($request);
        // return response()->json(['message' => $request->all()]);
    }

    public function logout(Request $request) {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'OK'], 200);
    }
}
