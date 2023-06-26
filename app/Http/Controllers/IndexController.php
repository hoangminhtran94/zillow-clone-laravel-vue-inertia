<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Str;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $listings = Listing::all()->random(3);


        $returnData = $listings->map(function ($listing) {
            $images = $listing->images;
            $listing_image = count($images) > 0 ? $images[0]->src : "/images/placeholder.png";
            $listing["listing_image"] = $listing_image;
            $listing["owner_name"] = $listing->owner->name;
            return $listing;
        });
        return inertia("Home/Index", ["listings" => $returnData]);
    }
    public function search(Request $request)
    {

        $filter = $request->only(["listing_address"]);
        $results = count($filter) > 0 ? Listing::all()->filter(fn ($listing) => Str::contains($listing->listing_address, $filter["listing_address"]))->values()->all() : [];

        return response()->json(["results" => $results]);
    }
}
