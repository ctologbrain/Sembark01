<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shortUrl extends Model
{
    /** @use HasFactory<\Database\Factories\ShortUrlFactory> */
    use HasFactory;
    protected $fillable = [
        'url',
        'user_id',
        'No_of_hits',
        'company_id',
        
    ];
    public function user()
    {
        return $this->hasMany(\App\Models\User::class,'user_id','id');
    }

    public function UserDetails()
    {
        return $this->belongsTo(\App\Models\User::class,'user_id','id');
    }
}
