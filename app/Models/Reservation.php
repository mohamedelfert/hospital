<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = ['id', 'name', 'phone', 'address', 'age', 'gender',
        'examination_id', 'specialty_id', 'doctor_id', 'day_id', 'date', 'price', 'code', 'is_completed'];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function day()
    {
        return $this->belongsTo(Workdays::class);
    }
}
