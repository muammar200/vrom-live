<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'photos' => 'array'
    ];

    // public function brand(): BelongsTo
    // {
    //     return $this->belongsTo(Brand::class, 'brand_id', 'id');
    // }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function bookings() : HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
