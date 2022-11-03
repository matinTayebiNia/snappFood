<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "slug", "icon", "parent_id", "type"
    ];

    protected $guarded = ["id"];

    public function placeTypes(): BelongsToMany
    {
        return $this->belongsToMany(PlaceType::class,"category_placetype","category_id","placetype_id");
    }

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
