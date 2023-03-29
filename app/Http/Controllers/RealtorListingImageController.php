<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(ListingImage::class, "image");
    // }
    public function create(Listing $listing)
    {
        $listing->load(["images"]);
        return inertia(
            "Realtor/ListingImage/Create",
            ["listing" => $listing]
        );
    }

    public function store(Listing $listing, Request $request)
    {
        if ($request->hasFile("images")) {
            $request->validate(["images.*" => "mimes:png,jpg,jpeg|max:5000"], ["images.*.mimes" => "File should be an image (jpg,jpeg,png)"]);

            foreach ($request->file("images") as $file) {
                $path = $file->store("images", "public");
                $listing->images()->save(new ListingImage(["filename" => $path]));
            }
        }
        return redirect()->back()->with("success", "Upload image successfully");
    }
    public function destroy(Listing $listing, ListingImage $image)
    {
        Storage::disk("public")->delete($image->filename);
        $image->delete();
        return redirect()->back()->with(["success" => "Deleted successfully"]);
    }
}
