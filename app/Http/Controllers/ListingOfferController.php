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
        $offers = Offer::byMe()->with(["listing.owner", "listing.images"])->get();
        $returnData = $offers->map(function ($offer) {
            $listing = $offer->listing;
            $listing_info = "{$listing->street_number} {$listing->street}, {$listing->city}, {$listing->code}";
            $owner = $offer->listing->owner;
            $images = $offer->listing->images;
            $listing_image = count($images) > 0 ? $images[0] : "";
            return [
                "id" => $offer->id,
                "created_at" => $offer->created_at,
                "amount" => $offer->amount,
                "accepted_at" => $offer->accepted_at,
                "rejected_at" => $offer->rejected_at,
                "listing_id" => $offer->listing_id,
                "listing_info" => $listing_info,
                "listing_date" => $listing->created_at,
                "listing_image" => $listing_image,
                "owner_id" => $owner->id,
                "owner_email" => $owner->email,
                "owner_name" => $owner->name,
                "owner_phone" => $owner->phone_number,
            ];
        });
        return  inertia("Listing/YourOffers", ['offers' => $returnData]);
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
