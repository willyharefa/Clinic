<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function checkup()
    {
        return $this->belongsTo(Checkup::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
