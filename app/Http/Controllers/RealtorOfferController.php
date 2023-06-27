<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Http\Request;

class RealtorOfferController extends Controller
{
    public function index(Listing $listing)
    {
        $this->authorize('view', $listing);
        $listing->load(["offers", "offers.bidder"]);
        return inertia("Realtor/Offer", ["listing" => $listing]);
    }
    public function show(Listing $listing, Offer $offer)
    {
    }
    public function update(Listing $listing, Offer $offer, Request $request)
    {
        $this->authorize('update', $listing);
        $status = $request->status;

        if ($status === "accept") {
            $offer->update(["accepted_at" => now()]);
            $listing->sold_at = now();
            $listing->save();

            $listing->offers()->except($offer)
                ->update(['rejected_at' => now()]);

            return redirect()->back()->with(["success" => "Offer #{$offer->id} accepted"]);
        }

        if ($status === "reject") {
            $offer->update(['rejected_at' => now()]);
            return redirect()->back()->with(["success" => "Offer #{$offer->id} rejected"]);
        }
    }
}
