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
use Illuminate\Validation\Rule;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia("UserAccount/Create");
    }

    public function index()
    {
        $authenticatedUser = Auth::user();
        if (!$authenticatedUser) {
            return redirect()->route("login");
        }
        $user = User::find($authenticatedUser->id)->load("profileImage");;
        return inertia("Profile/Index", ["user" => $user]);
    }


    public function change_password(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            "current_password" => ["required", "min:8", function ($attribute, $value, $fail) {
                $user = Auth::user();
                if (Hash::check($value, $user->password === false)) {
                    $fail("Incorrect password");
                } else {
                    return;
                }
            }],
            "new_password" => "required|min:8|confirmed",
        ]);

        $user->update(["password" => $request->input("new_password")]);
        return redirect()->route("your-profile.index")->with("success", "Password changed");
    }


    public function display_edit_profile()
    {
        $user = Auth::user()->load("profileImage");
        return inertia("Profile/Edit", ["user" => $user]);
    }

    public function save_edit_profile(Request $request)
    {
        $user = Auth::user()->load("profileImage");
        $file = $request->file("profile_image");
        if ($file) {
            try {
                $path = Storage::putFile("zillow-clone/public", $file);
                if ($user->profileImage != null) {
                    $fileToDelete = $user->profileImage->filename;
                    if (Storage::exists($fileToDelete)) {
                        Storage::delete($fileToDelete);
                    }
                    $user->profileImage->filename = $path;
                    $user->profileImage->save();
                } else {
                    $user->profileImage()->save(new ProfileImage(["filename" => $path]));
                }
            } catch (Exception $ex) {
                return redirect()->route("edit-profile-page ")->withErrors("error", "Something wrong happened");
            }
        }

        $user->update($request->validate([
            "name" => "required",
            "phone_number" => "required",
            "address" => "required",
            "postal_code" => "required"
        ]));


        return redirect()->route("your-profile.index")->with("success", "Profile edited");
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
