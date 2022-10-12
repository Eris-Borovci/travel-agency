<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $primaryKey = "photo_id";

    protected $table = "property_photos";

    protected $fillable = [
        "property_id"
    ];

    function property() {
        return $this->belongsTo(Property::class, 'id', 'property_id');
    }
}
