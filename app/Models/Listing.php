<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasUuids;
    public $incrementing = false;
    protected $fillable = ["beds", "baths", "area", "city", "code", "street", "street_number", "price", "deleted_at"];
    protected $sortable = ["price", "created_at"];
    protected $appends = ["listing_address"];

    public function getListingAddressAttribute()
    {
        return "{$this->street_number} {$this->street}, {$this->city}, {$this->code}";
    }



    public function owner(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, "by_user_id");
    }

    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }


    public function scopeFilter($query, array $filters)
    {

        return $query->when(
            $filters["priceFrom"] ?? false,
            fn ($query, $value) => $query->where("price", ">=", $value)
        )
            ->when(
                $filters["priceTo"] ?? false,
                fn ($query, $value) => $query->where("price", "<=", $value)
            )->when(
                $filters["baths"] ?? false,
                fn ($query, $value) => $query->where("baths", (int)$value === 6 ? ">=" : "=", $value)
            )->when(
                $filters["beds"] ?? false,
                fn ($query, $value) => $query->where("beds", (int)$value === 6 ? ">=" : "=", $value)
            )->when(
                $filters["areaFrom"] ?? false,
                fn ($query, $value) => $query->where("area", ">=", $value)
            )->when(
                $filters["areaTo"] ?? false,
                fn ($query, $value) => $query->where("area", "<=", $value)
            )->when(
                $filters["deleted"] ?? false,
                fn ($query, $value) => $query->onlyTrashed()
            )->when(
                $filters["by"] ?? false,
                fn ($query, $value) =>
                !in_array($value, $this->sortable) ? $query : $query->orderBy($value, $filters["order"] ?? "desc")
            );
    }
    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, "listing_id");
    }
    public function scopeWithoutSold(Builder $query): Builder
    {
        return $query->whereNull("sold_at");
    }
}
