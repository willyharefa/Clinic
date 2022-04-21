<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'date_expired' => 'date',
        'date_of_entry' => 'date'
    ];


    public function prescription()
    {
        return $this->hasOne(Prescription::class);
    }
}
