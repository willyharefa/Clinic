<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    protected $guard = 'doctor';
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birthday' => 'date'
    ];


    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointmen::class);
    }

    public function checkup()
    {
        return $this->hasOne(Checkup::class);
    }

}
