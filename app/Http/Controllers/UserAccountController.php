<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileImage;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia("UserAccount/Create");
    }
    public function store(Request $request)
    {

        $user = User::create($request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|confirmed",
            "password_confirmation" => "required|same:password",
            "phone_number" => "required",
            "address" => "required",
            "postal_code" => "required"
        ]));
        $file = $request->file("profile_image");
        $path = $file->store("images", "public");
        $user->profileImage()->save(new ProfileImage(["filename" => $path]));


        Auth::login($user);
        event(new Registered($user));
        return redirect()->route("listing.index")->with("success", "Account created");
    }
}
