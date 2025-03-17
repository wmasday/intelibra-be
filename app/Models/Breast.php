<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Breast extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'side', 'temprature', 'volume'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
