<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileImage;
use Illuminate\Support\Facades\Storage;
use Exception;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia("UserAccount/Create");
    }
    public function store(Request $request)
    {

        $file = $request->file("profile_image");
        $path = Storage::putFile("zillow-clone/public", $file);

        $user = User::create($request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|confirmed",
            "password_confirmation" => "required|same:password",
            "phone_number" => "required",
            "address" => "required",
            "postal_code" => "required"
        ]));


        $user->profileImage()->save(new ProfileImage(["filename" => $path]));


        Auth::login($user);
        event(new Registered($user));
        return redirect()->route("listing.index")->with("success", "Account created");
    }
}
