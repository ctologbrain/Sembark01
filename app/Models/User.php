<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'client_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function Role()
    {
        return $this->hasMany(\App\Models\Role::class,'role_id','id');
    }

    public function RoleDetails()
    {
        return $this->belongsTo(\App\Models\Role::class,'role_id','id');
    }
    public function Company()
    {
        return $this->hasMany(\App\Models\Client::class,'client_id','id');
    }

    public function CompanyDetails()
    {
        return $this->belongsTo(\App\Models\Client::class,'client_id','id');
    }
}
