<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'date_checkup' => 'date'
    ];

    public function appointmen()
    {
        return $this->belongsTo(Appointmen::class);
    }

    public function laboratory()
    {
        return $this->hasMany(Laboratory::class);
    }

    public function prescription()
    {
        return $this->hasMany(Prescription::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
