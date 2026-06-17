<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'project_id',
        'category',
        'amount',
        'date',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
