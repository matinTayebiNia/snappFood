<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlaceType extends Model
{
    use HasFactory;

    protected $table = "placetypes";

    protected $fillable = ["name", "icon", "slug"];
    protected $guarded = ["id"];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,"category_placetype","placetype_id","category_id");
    }

    public function places(): BelongsToMany
    {
        return $this->belongsToMany(Place::class, "place_placetype", "placetype_id", "place_id");
    }

}
