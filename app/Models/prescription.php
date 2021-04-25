<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'note',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }


}
