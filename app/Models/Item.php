<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'photos' => 'array'
    ];
    
    public function getThumbnailAttribute() //menambahkan field thumbnail
    {
        if($this->photos){
            return Storage::url(json_decode($this->photos)[0]);
            
        }

        return 'https://via.placeholder.com/800X600';
    }

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
