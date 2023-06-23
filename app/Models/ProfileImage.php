<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProfileImage extends Model
{
    use HasFactory, HasUuids;
    public $incrementing = false;
    protected $fillable = ["filename"];
    protected $appends = ["src"];
    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class);
    }
    public function getSrcAttribute()
    {
        return  Storage::disk('s3')->url($this->filename);
    }
}
