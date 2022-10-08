<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Examination extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $table = 'examinations';

    protected $fillable = ['id', 'name', 'notes'];

    public function price()
    {
        return $this->belongsTo(ListPrice::class);
    }
}
