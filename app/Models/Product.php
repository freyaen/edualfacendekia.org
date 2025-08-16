<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid',
    $guarded = [];

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('d F Y');
    }
}
