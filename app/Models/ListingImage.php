<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Listing;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class ListingImage extends Model
{
    use HasFactory, HasUuids;
    public $incrementing = false;
    protected $fillable = ["filename"];
    protected $appends = ["src"];
    public function listing(): BelongsTo
    {
        return  $this->belongsTo(Listing::class);
    }
    public function getSrcAttribute()
    {
        return  Storage::url($this->filename);
    }
}
