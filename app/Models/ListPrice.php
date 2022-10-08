<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListPrice extends Model
{
    protected $table = 'list_prices';

    protected $fillable = ['id', 'examination_id', 'specialty_id', 'price'];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function examination()
    {
        return $this->belongsTo(Examination::class);
    }
}
