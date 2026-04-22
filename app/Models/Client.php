<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
    ];
    public function User()
    {
        return $this->hasMany(\App\Models\User::class,'id','client_id');
    }

    public function UserDetails()
    {
        return $this->belongsTo(\App\Models\User::class,'id','client_id');
    }
    public function ShortUrl()
    {
        return $this->hasMany(\App\Models\shortUrl::class,'id','company_id');
    }

    public function ShortUrlDetails()
    {
        return $this->belongsTo(\App\Models\shortUrl::class,'id','company_id');
    }
}
