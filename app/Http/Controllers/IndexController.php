<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;


class IndexController extends Controller
{
    public function index()
    {
        $listings = Listing::all()->random(3);
        $returnData = $listings->map(function ($listing) {
            $images = $listing->images;
            $listing_image = count($images) > 0 ? $images[0]->src : "/images/placeholder.png";
            $listing["listing_image"] = $listing_image;
            $listing["listing_address"] = "{$listing->street_number} {$listing->street}, {$listing->city}, {$listing->code}";
            $listing["owner_name"] = $listing->owner->name;
            return $listing;
        });
        return inertia("Home/Index", ["listings" => $returnData]);
    }
}
