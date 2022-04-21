<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointmen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    protected $casts = [
        'date_book' => 'date'
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function checkup()
    {
        return $this->hasOne(Checkup::class);
    }
}
