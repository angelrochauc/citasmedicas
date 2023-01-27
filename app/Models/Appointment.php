<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\specialty;
use App\Models\user;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable=[
        'scheduled_time',
        'scheduled_date',
        'type',
        'description',
        'doctor_id',
        'patient_id',
        'specialty_id'
    ];

    public function specialty(){
        return $this->belongsTo(Specialty::class);
    }

    public function doctor(){
        return $this->belongsTo(User::class);
    }

    public function patient(){
        return $this->belongsTo(User::class);
    }

    public function getScheduledTime12Attribute(){
        return (new Carbon($this->scheduled_time))
            ->format('g:i A');
    }
}
