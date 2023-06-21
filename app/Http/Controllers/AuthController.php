<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller

{
    public function index(Request $request)
    {
        $authenticatedUser = Auth::user();
        if (!$authenticatedUser) {
            return redirect()->route("login");
        }
        $user = User::find($authenticatedUser->id)->load("profileImage");;
        return inertia("Profile/Index", ["user" => $user]);
    }

    public function create()
    {
        return inertia("Auth/Login");
    }

    public function store(Request $request)
    {
        if (!Auth::attempt($request->validate([
            "email" => "required|string|email",
            "password" => "required|string",
        ]), true)) {
            throw ValidationException::withMessages(["email" => "Authentication failed", "password" => "Authentication failed"]);
        }
        $request->session()->regenerate();
        return redirect()->route("listing.index");
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("listing.index");
    }
}
