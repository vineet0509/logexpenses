<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contractor extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'phone',
        'specialty',
        'location',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
