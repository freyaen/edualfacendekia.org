<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Store extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid',
    $guarded = [];

    public function getFormattedCreatedAtAttribute()
{
    return Carbon::parse($this->created_at)->translatedFormat('d F Y');
}
}
