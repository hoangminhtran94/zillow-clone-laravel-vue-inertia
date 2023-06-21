<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;

class ListingOfferController extends Controller
{
    public function index()
    {
        $offers = Offer::byMe()->get();
        return  inertia("Listing/YourOffers", ['offers' => $offers]);
    }

    public function store(Listing $listing, Request $request)
    {
        $userId = $request->user()->id;
        $creatorId = $listing->owner->id;
        $this->authorize('view', $listing);
        if ($userId !== $creatorId) {
            $offer = $listing->offers()->save(
                Offer::make(
                    $request->validate([
                        "amount" => "required|integer|min:1",
                    ])
                )->bidder()->associate($request->user())
            );
            $listing->owner->notify(new OfferMade($offer));
            return redirect()->back()->with("success", "Offer was made");
        }
    }
}
