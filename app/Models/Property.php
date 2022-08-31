<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
    ];

    function partner(){
        return $this->belongsTo(User::class, 'id');
    }

    function photos(){
        return $this->hasMany(Photo::class, 'property_id');
    }
}
