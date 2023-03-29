<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, "listing");
    }
    public function index(Request $request)
    {
        $filters = ["deleted" => $request->boolean("deleted"), ...$request->only(["by", "order"])];

        return inertia(
            "Realtor/Index",
            [
                "listings" =>
                $request
                    ->user()
                    ->listings()
                    ->filter($filters)
                    ->withCount("images")
                    ->withCount("offers")
                    ->paginate(6)
                    ->withQueryString(),
                "filters" => $filters
            ]
        );
    }

    public function edit(Listing $listing)
    {
        return inertia("Realtor/Edit", ["listing" => $listing]);
    }

    public function show(Listing $listing)
    {
        $listing->load(["images"]);
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();

        return inertia("Listing/Show", ["listing" => $listing, "offerMade" => $offer]);
    }

    public function create()
    {
        $this->authorize("create", Listing::class);
        return inertia("Realtor/Create");
    }
    public function update(Request $request, Listing $listing)
    {
        $listing->update([...$request->all(), ...$request->validate([
            "beds" => "required|integer|min:0|max:20",
            "baths" => "required|integer|min:0|max:10",
            "area" => "required|integer|min:50|max:500",
            "city" => "string|required",
            "code" => "string|required",
            "street" => "string|required",
            "street_number" => "required|integer|min:1|max:500",
            "price" => "required|integer|min:100|max:1000000"
        ])]);
        return redirect()->route('listing.index')->with("success", "Listing was updated!");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create([...$request->all(), ...$request->validate([
            "beds" => "required|integer|min:0|max:20",
            "baths" => "required|integer|min:0|max:10",
            "area" => "required|integer|min:50|max:500",
            "city" => "string|required",
            "code" => "string|required",
            "street" => "string|required",
            "street_number" => "required|integer|min:1|max:500",
            "price" => "required|integer|min:100|max:1000000"
        ])]);

        return redirect()->route('listing.index')->with("success", "Listing was created!");
    }



    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();
        return redirect()->back()->with("success", "Listing was deleted");
    }

    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()->back()->with("success", "Listing was restore");
    }
}
