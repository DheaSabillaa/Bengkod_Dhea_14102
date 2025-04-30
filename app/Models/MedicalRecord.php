<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'medical_note',
        'appointment_date',
        'user_id',
        'status',
        'medicine_cost',
        'total_cost',
    ];
}