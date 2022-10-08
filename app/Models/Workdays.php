<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Workdays extends Model
{
    use HasTranslations;

    public $translatable = ['day'];

    protected $table = 'workdays';

    protected $fillable = ['id', 'day', 'doctor_id'];

    public function doctors()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
}
