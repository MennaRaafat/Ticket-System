<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public function isAdmin(){
        if ($this -> email === "mennaraafat866@gmail.com")
        return true;
    }

    public function ticket(){
        return $this ->hasMany(Ticket::class);
    }

    public function generateOTP(){
        $this -> timestamps = false;
        $this -> otp = rand(1000,9999);
        $this -> expiration = now()->addMinutes(30);
        $this -> save();
    }

    public function resetOTP(){
        $this -> timestamps = false;
        $this -> otp = null;
        $this -> expiration = null;
        $this -> save();
    }
}
