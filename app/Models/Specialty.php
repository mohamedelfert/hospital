<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialty extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'specialties';

    protected $fillable = ['id', 'name', 'notes'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function prices()
    {
        return $this->hasMany(ListPrice::class);
    }
}
