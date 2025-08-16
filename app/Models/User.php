<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Add this to specify which columns get UUIDs
    protected $uuidVersion = 'ordered'; // or 'regular' if you prefer

    public function cart(){
        return $this->hasOne(Cart::class);
    }

     public function store(){
        return $this->belongsTo(Store::class);
    }

        public function ordersActive(){
            return $this->hasMany(Order::class)
            ->where('status', '!=', 'selesai');
        }
}