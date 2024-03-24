<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function items() : HasMany
    {
        return $this->hasMany(Item::class);
    }

    // public function items() : HasMany
    // {
    //     return $this->hasMany(Item::class, 'brand_id', 'id');
    // }


}
