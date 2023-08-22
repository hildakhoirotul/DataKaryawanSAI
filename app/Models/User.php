<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $dates = ['remember_token_created_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'is_admin',
        'email',
        'email_verified_at',
        'chain',
        'password',
        'password_changed',
        'verify_key',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function is_admin()
    {
        return $this->is_admin === 1;
    }

    public function changePassword($newPassword)
    {
        $this->update([
            'password' => Hash::make($newPassword)
        ]);
    }

    // public function setRememberToken($value)
    // {
    //     parent::setRememberToken($value);
    //     $this->remember_token_created_at = now();
    // }

    // public function isRememberTokenValid()
    // {
    //     if ($this->remember_token) {
    //         return true;
    //     } else {
    //         return false;
    //     }

    //     $expireTime = config('auth.providers.users.remember.expire');

    //     return $this->remember_token_created_at
    //         && $this->remember_token_created_at->timestamp + $expireTime >= now()->timestamp;
    // }
}
