<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon'];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_feature');
    }
}
