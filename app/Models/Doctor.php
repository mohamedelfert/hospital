<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Doctor extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'doctors';

    protected $fillable = ['id', 'name', 'phone', 'email', 'address', 'gender', 'specialty_id', 'image'];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return asset('/uploads/doctors_images/' . $this->image);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function workdays()
    {
        return $this->hasMany(Workdays::class);
    }
}
